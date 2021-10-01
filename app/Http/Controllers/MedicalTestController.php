<?php

namespace App\Http\Controllers;

use App\Models\MedicalTest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MedicalTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('MedicalTest', [
            'medicalTestList' => MedicalTest::latest()->paginate(5),
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
        $request->validate([
            'name' => ['required', 'max:50'],
        ]);
        $medicalTest = new MedicalTest();
        $medicalTest->fill($request->all());
        $medicalTest->save();
        return back()->with([
            'success' => true,
            'message' => 'Medical Test created successfully.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MedicalTest  $medicalTest
     * @return \Illuminate\Http\Response
     */
    public function show(MedicalTest $medicalTest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MedicalTest  $medicalTest
     * @return \Illuminate\Http\Response
     */
    public function edit(MedicalTest $medicalTest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MedicalTest  $medicalTest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MedicalTest $medicalTest)
    {

        $request->validate([
            'name' => ['required', 'max:50'],
        ]);
        $medicalTest->fill($request->all());
        $medicalTest->save();
        return back()->with([
            'success' => true,
            'message' => 'Medical Test updated successfully.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MedicalTest  $medicalTest
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicalTest $medicalTest)
    {
        $medicalTest->delete();
        return back()->with([
            'success' => true,
            'message' => 'Medical Test deleted successfully.'
        ]);
    }
}
