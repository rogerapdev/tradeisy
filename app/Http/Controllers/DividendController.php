<?php

namespace App\Http\Controllers;

use App\Http\Requests\DividendRequest;
use App\Repositories\DividendRepository;

class DividendController extends Controller
{

    /**
     * @var DividendRepository
     */
    protected $repository;

    public function __construct(DividendRepository $repository = null)
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

        $dividends = $this->repository->paginate(15);
        $links = str_replace('/?', '?', $dividends->render());

        return view('dividends.index', compact('dividends', 'links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $dividend = $this->repository->makeModel();
        $brokers = $this->brokers();

        return view('dividends.form', compact('dividend', 'brokers'));
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

        $dividend = $this->repository->find($id);
        $brokers = $this->brokers();

        return view('dividends.form', compact('dividend', 'brokers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(DividendRequest $request)
    {
        try {
            $dividend = $this->repository->create($request->all());
        } catch (Exception $e) {
            // flash(trans('messages.error.created'))->error();
            return back()->withInput();
        }

        // flash(trans('messages.city.saved', ['cityId' => $city->id]))->success();

        return redirect('dividends');
    }

    /**
     * Update the given resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(DividendRequest $request, $id)
    {
        try {
            $this->repository->update($request->all(), $id);
        } catch (Exception $e) {
            // flash(trans('messages.error.updated'))->error();
            return back()->withInput();
        }

        // flash(trans('messages.city.saved', ['cityId' => $id]))->success();

        return redirect('dividends');
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
            // flash(trans('messages.error.deleted'))->error();
            return back();
        }

        // flash(trans('messages.city.deleted', ['cityId' => $id]))->success();

        return redirect('dividends');
    }

    private function brokers()
    {
        $instance = app()->make('App\Models\Broker');
        return ['0' => '---'] + $instance->orderBy('id')->pluck('name', 'id')->all();

    }
}
