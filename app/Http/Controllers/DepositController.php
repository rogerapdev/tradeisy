<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepositRequest;
use App\Repositories\DepositRepository;

class DepositController extends Controller
{

    /**
     * @var DepositRepository
     */
    protected $repository;

    public function __construct(DepositRepository $repository = null)
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

        $deposits = $this->repository->with(['broker'])->paginate(15);
        $links = str_replace('/?', '?', $deposits->render());

        return view('deposits.index', compact('deposits', 'links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $deposit = $this->repository->makeModel();
        $brokers = $this->brokers();

        return view('deposits.form', compact('deposit', 'brokers'));
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

        $deposit = $this->repository->find($id);
        $brokers = $this->brokers();

        return view('deposits.form', compact('deposit', 'brokers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(DepositRequest $request)
    {
        try {
            $deposit = $this->repository->create($request->all());
        } catch (Exception $e) {
            return back()->withInput();
        }

        return redirect('deposits');
    }

    /**
     * Update the given resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(DepositRequest $request, $id)
    {
        try {
            $this->repository->update($request->all(), $id);
        } catch (Exception $e) {
            return back()->withInput();
        }

        return redirect('deposits');
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

        return redirect('deposits');
    }

    private function brokers()
    {
        $instance = app()->make('App\Models\Broker');
        return ['0' => '---'] + $instance->orderBy('id')->pluck('name', 'id')->all();

    }
}
