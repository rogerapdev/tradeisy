<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrokerRequest;
use App\Repositories\BrokerRepository;

class BrokerController extends Controller
{

    /**
     * @var BrokerRepository
     */
    protected $repository;

    public function __construct(BrokerRepository $repository = null)
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

        $brokers = $this->repository->paginate(15);
        $links = str_replace('/?', '?', $brokers->render());

        return view('brokers.index', compact('brokers', 'links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $broker = $this->repository->makeModel();

        return view('brokers.form', compact('broker'));
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

        $broker = $this->repository->find($id);

        return view('brokers.form', compact('broker'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(BrokerRequest $request)
    {
        try {
            $broker = $this->repository->create($request->all());
        } catch (Exception $e) {
            return back()->withInput();
        }

        return redirect('brokers');
    }

    /**
     * Update the given resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(BrokerRequest $request, $id)
    {
        try {
            $this->repository->update($request->all(), $id);
        } catch (Exception $e) {
            return back()->withInput();
        }

        return redirect('brokers');
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

        return redirect('brokers');
    }
}
