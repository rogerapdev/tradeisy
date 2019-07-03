<?php

namespace App\Http\Controllers;

use App\Http\Requests\RadarRequest;
use App\Repositories\RadarRepository;

class RadarController extends Controller
{

    /**
     * @var RadarRepository
     */
    protected $repository;

    public function __construct(RadarRepository $repository = null)
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

        $radars = $this->repository->all();

        return view('radars.index', compact('radars'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(RadarRequest $request)
    {
        try {
            $radar = $this->repository->create($request->all());
        } catch (Exception $e) {
            return back()->withInput();
        }

        return redirect('radars');
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

        return redirect('radars');
    }

}
