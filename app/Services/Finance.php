<?php
namespace App\Services;

use App\Services\YahooFinanceAPI;
use Sunra\PhpSimple\HtmlDomParser;

/**
 *
 */
class Finance
{

    /**
     * All groups and user permissions
     *
     * @var array
     */
    protected $recursos = [
        'wall_street_journal',
        'bloomberg',
        'msn',
        'reuters',
        'marketwatch',
        'barrons',
        'financial_times',
        'morningstar',
        'advfn',
        'gurufocus',
        'clubeinvest',
        'tradingeconomics',
    ];

    private $preco_cotacao = 0;

    public function cotacoes($ativos)
    {

        // https://github.com/nategood/httpful
        $cotacoes = [];

        $i = rand(0, 10);
        // echo 'index ' . $i . '<br/>';

        if ($i > 5) {

            $tickersArray = [];
            $object = new YahooFinanceAPI;
            foreach ($ativos as $key => $value) {
                $tickersArray[] = $value . '.SA';
            }
            $cotacoes_encontradas = $object->api($tickersArray, true);

            foreach ($cotacoes_encontradas as $key => $cotacao) {
                $cotacoes[] = ['ativo' => str_replace('.SA', '', $cotacao['Symbol']), 'valor_atual' => $cotacao['LastTradePriceOnly']];
            }

            // foreach ($ativos as $key => $value) {
            //         $valor = $this->cotacaoAtual($value);
            //         $cotacoes[] = ['ativo' => $value, 'valor_atual' => $valor];
            // }

        } else {

            $url = 'http://finance.google.com/finance/info?q=BVMF:' . implode(',BVMF:', $ativos);

            $json = file_get_contents($url);
            $temp = explode('//', $json);
            $cotacoes_encontradas = json_decode($temp[1], true);

            foreach ($cotacoes_encontradas as $key => $cotacao) {
                $cotacoes[] = ['ativo' => $cotacao['t'], 'valor_atual' => $cotacao['l']];
            }
        }

        return $cotacoes;

    }

    public function cotacaoAtual($simbolo_ativo)
    {

        $contador = 0;
        $this->preco_cotacao = 0;
        while ($this->preco_cotacao <= 0 && $contador <= 5) {

            $index = rand(0, count($this->recursos) - 1);
            $metodo = $this->recursos[$index];

            if (method_exists($this, camel_case($metodo))) {
                $this->{camel_case($metodo)}($simbolo_ativo);
            }

            if (method_exists($this, $metodo)) {
                $this->{$metodo}($simbolo_ativo);
            }

            $contador++;
        }

        return floatval($this->preco_cotacao);

    }

    private function googleFinance($simbolo_ativo)
    {
        if (is_array($simbolo_ativo)) {
            # code...
        }
        // http: //finance.google.com/finance/info?q=BVMF:VALE5,BVMF:USIM5
    }

    private function wallStreetJournal($simbolo_ativo)
    {
        try {
            $url = 'http://quotes.wsj.com/BR/' . $simbolo_ativo;

            $dom = HtmlDomParser::file_get_html($url, false, null, 0);
            $elems = $dom->find('span[id=quote_val]');
            if ($elems) {
                $this->preco_cotacao = preg_replace('/[^0-9.]*/', '', $elems[0]->plaintext);
            }

        } catch (Exception $e) {
            $this->preco_cotacao = 0;
        }
    }

    private function bloomberg($simbolo_ativo)
    {
        try {
            $url = 'https://www.bloomberg.com/quote/' . $simbolo_ativo . ':BZ';

            $dom = HtmlDomParser::file_get_html($url, false, null, 0);
            $elems = $dom->find('div[class=price]');
            if ($elems) {
                $this->preco_cotacao = preg_replace('/[^0-9.]*/', '', $elems[0]->plaintext);
            }

        } catch (Exception $e) {
            $this->preco_cotacao = 0;
        }
    }

    private function msn($simbolo_ativo)
    {
        try {
            $url = 'https://www.msn.com/en-us/money/stockdetails/fi-56.1.' . $simbolo_ativo . '.BSP?symbol=' . $simbolo_ativo;

            $dom = HtmlDomParser::file_get_html($url, false, null, 0);
            $elems = $dom->find('div[class=precurrentvalue]/span');
            if ($elems) {
                $this->preco_cotacao = preg_replace('/[^0-9.]*/', '', $elems[0]->plaintext);
            }

        } catch (Exception $e) {
            $this->preco_cotacao = 0;
        }
    }

    private function reuters($simbolo_ativo)
    {
        try {
            $url = 'http://www.reuters.com/finance/stocks/overview?symbol=' . $simbolo_ativo . '.SA';

            $dom = HtmlDomParser::file_get_html($url, false, null, 0);
            $elems = $dom->find('div[class=sectionQuoteDetail]/span');
            if ($elems) {
                $this->preco_cotacao = preg_replace('/[^0-9.]*/', '', $elems[1]->plaintext);
            }

        } catch (Exception $e) {
            $this->preco_cotacao = 0;
        }
    }

    private function marketwatch($simbolo_ativo)
    {
        try {
            $url = 'http://www.marketwatch.com/investing/stock/' . $simbolo_ativo . '?countrycode=br';

            $dom = HtmlDomParser::file_get_html($url, false, null, 0);
            $elems = $dom->find('div[class=pricewrap]/p');
            if ($elems) {
                $this->preco_cotacao = preg_replace('/[^0-9.]*/', '', $elems[1]->plaintext);
            }

        } catch (Exception $e) {
            $this->preco_cotacao = 0;
        }
    }

    private function barrons($simbolo_ativo)
    {
        try {
            $url = 'http://www.barrons.com/quote/stock/br/bvmf/' . $simbolo_ativo;

            $dom = HtmlDomParser::file_get_html($url, false, null, 0);
            $elems = $dom->find('span[class=market__price]');
            if ($elems) {
                $this->preco_cotacao = preg_replace('/[^0-9.]*/', '', $elems[0]->plaintext);
            }

        } catch (Exception $e) {
            $this->preco_cotacao = 0;
        }
    }

    private function financialTimes($simbolo_ativo)
    {
        try {
            $url = 'http://markets.ft.com/data/equities/tearsheet/profile?s=' . $simbolo_ativo . ':SAO';

            $dom = HtmlDomParser::file_get_html($url, false, null, 0);
            $elems = $dom->find('span[class=mod-ui-data-list__value]');
            if ($elems) {
                $this->preco_cotacao = preg_replace('/[^0-9.]*/', '', $elems[0]->plaintext);
            }

        } catch (Exception $e) {
            $this->preco_cotacao = 0;
        }
    }

    private function morningstar($simbolo_ativo)
    {
        try {
            $url = 'http://quotes.morningstar.com/stockq/c-header?&t=XBSP:' . $simbolo_ativo . '&region=bra';

            $dom = HtmlDomParser::file_get_html($url, false, null, 0);
            $elems = $dom->find('div[id=last-price-value]');
            if ($elems) {
                $this->preco_cotacao = preg_replace('/[^0-9.]*/', '', $elems[0]->plaintext);
            }

        } catch (Exception $e) {
            $this->preco_cotacao = 0;
        }
    }

    private function advfn($simbolo_ativo)
    {
        try {
            $url = 'http://www.advfn.com/stock-market/bovespa/' . $simbolo_ativo . '/stock-price';

            $dom = HtmlDomParser::file_get_html($url, false, null, 0);
            $elems = $dom->find('span[id=quoteElementPiece6]');
            if ($elems) {
                $this->preco_cotacao = preg_replace('/[^0-9.]*/', '', $elems[0]->plaintext);
            }

        } catch (Exception $e) {
            $this->preco_cotacao = 0;
        }

    }

    private function gurufocus($simbolo_ativo)
    {
        try {
            $url = 'http://www.gurufocus.com/stock/BSP:' . $simbolo_ativo;

            $dom = HtmlDomParser::file_get_html($url, false, null, 0);
            $elems = $dom->find('font[class=stock_header_price]');
            if ($elems) {
                $this->preco_cotacao = preg_replace('/[^0-9.]*/', '', $elems[0]->plaintext);
            }

        } catch (Exception $e) {
            $this->preco_cotacao = 0;
        }

    }

    private function clubeinvest($simbolo_ativo)
    {
        try {
            $url = 'http://www.clubeinvest.com/bolsa/bolsa_empresa.php?ticker=' . $simbolo_ativo . '.SA';

            $dom = HtmlDomParser::file_get_html($url, false, null, 0);
            $elems = $dom->find('table/tr/td/font/strong/font');
            if ($elems) {
                $this->preco_cotacao = preg_replace('/[^0-9.]*/', '', $elems[0]->plaintext);
            }

        } catch (Exception $e) {
            $this->preco_cotacao = 0;
        }

    }

    private function tradingeconomics($simbolo_ativo)
    {
        try {
            $url = 'http://www.tradingeconomics.com/' . $simbolo_ativo . ':bs';

            $dom = HtmlDomParser::file_get_html($url, false, null, 0);
            $elems = $dom->find('span[id=market_last]');
            if ($elems) {
                $this->preco_cotacao = preg_replace('/[^0-9.]*/', '', $elems[0]->plaintext);
            }

        } catch (Exception $e) {
            $this->preco_cotacao = 0;
        }

    }

}

// http://performance.morningstar.com/stock/performance-return.action?p=price_history_page&t=ECOR3&region=bra&culture=en-US
// http://quotes.wsj.com/BR/BVMF/ECOR3/historical-prices
// https://finance.google.com/finance/historical?q=BVMF:ECOR3
