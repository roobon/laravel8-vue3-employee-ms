<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::select('id', 'name')->get();
        $cities = City::orderBy('created_at')->get();
        return view("pages.cities.index", compact('cities', 'states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'state_id' => 'required',
            'name' => 'required|max:60|unique:cities',
        ]);

        $city = City::create([
            'state_id' => $request->state_id,
            'name' => ucfirst($request->name)
        ]);

        if ($city) {
            flash()->addSuccess('City Added');
        }

        return redirect(route('cities.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        $cities = City::orderBy('created_at')->get();
        $states = State::select('id', 'name')->get();
        return view('pages.cities.index', compact('cities', 'states', 'city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $request->validate([
            'state_id' => 'required',
            'name' => 'required|max:60|unique:cities,name,' . $city->name,
        ]);

        $city->update([
            'state_id' => $request->state_id,
            'name' => ucfirst($request->name)
        ]);

        flash()->addSuccess('City Updated');

        return redirect(route('cities.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();
        flash()->addSuccess('City Deleted');

        return redirect(route('cities.index'));
    }
}
