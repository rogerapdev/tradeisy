<?php

namespace App\Http\Controllers;

use App\Repositories\StockRepository;
use App\Services\Finance;

class StockController extends Controller
{

    /**
     * @var StockRepository
     */
    protected $repository;

    public function __construct(StockRepository $repository = null, Finance $finance = null)
    {

        $this->repository = $repository;
        $this->finance = $finance;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function quote()
    {

        $stocks = $this->repository->all();

        foreach ($stocks as $stock) {

            $stock->quote = $this->finance->cotacaoAtual($stock->stock_ticker);
            $stock->current_cost = $stock->quantity * $stock->quote;
            $stock->yield = $stock->current_cost - $stock->invested;
            $stock->gain = ($stock->yield * 100) / $stock->invested;

            $stock->save();
        }

        return redirect(route('dashboard'));
    }

}
