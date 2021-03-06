<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();

        return view('countries.index', [
            'countries' => $countries
        ]);
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
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'capital' => 'required',
            'population' => 'required'
        ]);

        if($validator->fails())
        {
            //return $validator->errors();
            
            return ['status' => false, 'message' => 'Data Validation Failed'];
        }
        

        $country = Country::create(request()->all());

        return ['status' => true, 'message' => 'Country Added Successfully', 'data' => $country];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'capital' => 'required',
            'population' => 'required'
        ]);

        if($validator->fails())
        {
            //return $validator->errors();
            
            return ['status' => false, 'message' => 'Data Validation Failed'];
        }

        $country = Country::find($id);

        $country->update(request()->except('id'));

        return ['status' => true, 'message' => 'Country Updated Successfully', 'data' => $country];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Country::find($id);

        $country->delete(); // soft delete
        //$country->forceDelete(); // forced delete

        return ['status' => true, 'message' => 'Country Deleted Successfully'];
    }
}
