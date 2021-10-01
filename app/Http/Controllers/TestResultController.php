<?php

namespace App\Http\Controllers;

use App\Models\MedicalTest;
use App\Models\TestResult;
use App\Models\TestResultItem;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TestResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('TestResult', [
            'testResultList' => TestResult::latest()->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('TestResultCreate', [
            'medicalTestList' => MedicalTest::latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->testResults[0]['result']){
            return back()->with([
                'success' => false,
                'message' => 'Please choose a test and insert result.'
            ]);
        }
        $request->validate([
            'patient_name' => ['required', 'max:50'],
            'patient_age' => ['required'],
            'patient_sex' => ['required',],
            'testResults' => ['required', 'array', 'min:1'],
        ]);
        $testResult = new TestResult();
        $testResult->fill($request->all());
        $testResult->save();
        foreach($request->testResults as $item){
            if(!$item['result']) continue;
            $testItem = new TestResultItem();
            $testItem->test_name = $item['medicalTest']['name'];
            $testItem->result = $item['result'];
            $testItem->reference_ranges = $item['reference_ranges'];
            $testItem->medical_test_id = $item['medicalTest']['id'];
            $testItem->test_result_id = $testResult->id;
            $testItem->save();
        }
        return redirect()->route('test-results.show', $testResult)->with([
            'success' => true,
            'message' => 'Invoice created successfully.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TestResult  $testResult
     * @return \Illuminate\Http\Response
     */
    public function show(TestResult $testResult)
    {
        $testResult->test_result_items();
        return Inertia::render('TestResultShow', [
            'testResult' => $testResult->load('test_result_items'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TestResult  $testResult
     * @return \Illuminate\Http\Response
     */
    public function edit(TestResult $testResult)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TestResult  $testResult
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TestResult $testResult)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TestResult  $testResult
     * @return \Illuminate\Http\Response
     */
    public function destroy(TestResult $testResult)
    {
        $testResult->delete();
        return back()->with([
            'success' => true,
            'message' => 'Test Result deleted successfully.'
        ]);
    }
}
