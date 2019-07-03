<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Repositories\OrderRepository;

class OrderController extends Controller
{

    /**
     * @var OrderRepository
     */
    protected $repository;

    public function __construct(OrderRepository $repository = null)
    {

        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $orders = $this->repository->with(['broker'])->orderBy('date', 'desc')->paginate(15);
        $links = str_replace('/?', '?', $orders->render());

        return view('orders.index', compact('orders', 'links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $order = $this->repository->makeModel();
        $brokers = $this->brokers();

        return view('orders.form', compact('order', 'brokers'));
    }

    /**
     * Show the form for editing the given resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $order = $this->repository->find($id);
        $brokers = $this->brokers();

        return view('orders.form', compact('order', 'brokers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        // dd($request->all());
        try {
            $order = $this->repository->create($request->all());
        } catch (Exception $e) {
            return back()->withInput();
        }

        return redirect('orders');
    }

    /**
     * Update the given resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, $id)
    {
        try {
            $this->repository->update($request->all(), $id);
        } catch (Exception $e) {
            return back()->withInput();
        }

        return redirect('orders');
    }

    /**
     * Delete the given resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            $this->repository->delete($id);
        } catch (Exception $e) {
            return back();
        }

        return redirect('orders');
    }

    private function brokers()
    {
        $instance = app()->make('App\Models\Broker');
        return ['0' => '---'] + $instance->orderBy('id')->pluck('name', 'id')->all();

    }
}
