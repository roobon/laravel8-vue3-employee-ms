<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function index()
    {
        $countries = Country::select('id', 'name')->get();
        $states = State::orderBy('created_at')->get();
        return view('pages.states.index', compact('states', 'countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required',
            'name' => 'required|unique:states',
        ]);

        $states = State::create([
            'country_id' => strtoupper($request->country_id),
            'name' => ucfirst($request->name)
        ]);

        if ($states) {
            flash()->addSuccess('State Added');
        }

        return redirect(route('states.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    // public function show(State $state)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        $countries = Country::select('id', 'name')->get();
        $states = State::orderBy('created_at')->get();

        return view('pages.states.index', compact('states', 'state', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, State $state)
    {
        $request->validate([
            'country_id' => 'required',
            'name' => 'required|max:60|unique:states,name,' . $state->id,
        ]);

        $state->update([
            'country_id' => $request->country_id,
            'name' => ucfirst($request->name)
        ]);

        flash()->addSuccess('State Updated');

        return redirect(route('states.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        $state->delete();
        flash()->addSuccess('State Deleted');

        return redirect(route('states.index'));
    }
}
