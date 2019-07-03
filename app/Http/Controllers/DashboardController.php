<?php

namespace App\Http\Controllers;

use App\Repositories\StockRepository;

// use Sunra\PhpSimple\HtmlDomParser;

class DashboardController extends Controller
{

    /**
     * @var StockRepository
     */
    protected $repository;

    public function __construct(StockRepository $repository = null)
    {

        $this->repository = $repository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // dd(holidays_sp('2017'));

        // $myDates = get_months_by_range('2017-07-31', date('Y-m-d'));
        // dd($myDates);

        // $option = new \AlphaVantage\Options();
        // $option->setApiKey(env('API_KEY_ALPHA_VANTAGE'));
        // $client = new \AlphaVantage\Client($option);
        // dd($client->timeSeries()->monthly('ECOR3.SA'));

        // https://www.alphavantage.co/query?function=TIME_SERIES_MONTHLY&symbol=ECOR3.SA&apikey=env('API_KEY_ALPHA_VANTAGE')

        // $url = "https://finance.yahoo.com/quote/ECOR3.SA?p=ECOR3.SA";
        // $dom = HtmlDomParser::file_get_html($url, false, null, 0);

        // $elems = $dom->find('div[id=quote-market-notice]');

        // dd($elems);

        // $csv = $this->readYahoo('AAPL', mktime(0, 0, 0, 6, 2, 2017), mktime(0, 0, 0, 6, 3, 2017));
        // dd($csv);

        // $this->teste();
        // dd(date("Y-m-t"));

        $stocks = $this->repository->orderBy('stock_ticker', 'asc')->all();

        return view('dashboard', compact('stocks'));
    }

    // public function readYahoo($symbol, $tsStart, $tsEnd)
    // {

    //     $html = file_get_contents("https://finance.yahoo.com/quote/ECOR3.SA?p=ECOR3.SA");
    //     dd($html);

    //     preg_match('"CrumbStore\":{\"crumb\":\"(?<crumb>.+?)\"}"',
    //         file_get_contents('https://uk.finance.yahoo.com/quote/' . $symbol),
    //         $crumb); // can contain \uXXXX chars
    //     if (!isset($crumb['crumb'])) {
    //         return 'Crumb not found.';
    //     }

    //     $crumb = json_decode('"' . $crumb['crumb'] . '"'); // \uXXXX to UTF-8
    //     foreach ($http_response_header as $header) {
    //         if (0 !== stripos($header, 'Set-Cookie: ')) {
    //             continue;
    //         }

    //         $cookie = substr($header, 14, strpos($header, ';') - 14); // after 'B='
    //     } // cookie looks like "fkjfom9cj65jo&b=3&s=sg"
    //     if (!isset($cookie)) {
    //         return 'Cookie not found.';
    //     }

    //     $fp = fopen('https://query1.finance.yahoo.com/v7/finance/download/' . $symbol
    //         . '?period1=' . $tsStart . '&period2=' . $tsEnd . '&interval=1d'
    //         . '&events=history&crumb=' . $crumb, 'rb', false,
    //         stream_context_create(array('http' => array('method' => 'GET',
    //             'header' => 'Cookie: B=' . $cookie))));
    //     if (false === $fp) {
    //         return 'Can not open data.';
    //     }

    //     $buffer = '';
    //     while (!feof($fp)) {
    //         $buffer .= implode(',', fgetcsv($fp, 5000)) . PHP_EOL;
    //     }

    //     fclose($fp);
    //     return $buffer;
    // }

    // private function teste()
    // {

    //     $url = "https://query1.finance.yahoo.com/v7/finance/download/ECOR3.SA?period1=1486765942&period2=1518301942&interval=1mo&events=history&crumb=3rZd/JgZGke";
    //     $return_data = @file_get_contents($url);
    //     $parts = explode(",", $return_data);
    //     dd($parts);
    // }
}
