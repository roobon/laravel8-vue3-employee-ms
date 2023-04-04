<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $countries = Country::orderBy('created_at')->get();
    return view('pages.countries.index', compact('countries'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  // public function create()
  // {
  //   //
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
      'country_code' => 'required|max:3|unique:countries',
      'name' => 'required|max:60',
    ]);

    $country = Country::create([
      'country_code' => strtoupper($request->country_code),
      'name' => ucfirst($request->name)
    ]);

    if ($country) {
      flash()->addSuccess('Country Added');
    }

    return redirect(route('countries.index'));
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Country  $country
   * @return \Illuminate\Http\Response
   */
  // public function show(Country $country)
  // {
  //   //
  // }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Country  $country
   * @return \Illuminate\Http\Response
   */
  public function edit(Country $country)
  {
    $countries = Country::orderBy('created_at')->get();
    return view('pages.countries.index', compact('countries', 'country'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Country  $country
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Country $country)
  {
    $request->validate([
      'country_code' => 'required|max:3|unique:countries',
      'name' => 'required|max:60',
    ]);

    $country->update([
      'country_code' => strtoupper($request->country_code),
      'name' => ucfirst($request->name)
    ]);

    flash()->addSuccess('Country Updated');

    return redirect(route('countries.index'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Country  $country
   * @return \Illuminate\Http\Response
   */
  public function destroy(Country $country)
  {
    $country->delete();
    flash()->addSuccess('Country Deleted');

    return redirect(route('countries.index'));
  }
}
