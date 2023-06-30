<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudyPlan;
use App\Models\StudyPlanBook;
use App\Models\StudyPlanTiming;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    { 
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $getPlan = StudyPlan::whereId($id)->first();
        $getStudyPlanBook = StudyPlanBook::with('plan_book_detail')->where('study_plan_id',$id)->get();
        
        // $getBook = Book::whereId($getStudyPlan->book_id)->first();
        // $getChapter = BookChapter::whereIn('id',$getStudyPlan->chapter_ids)->pluck('chapter_title')->implode(',');

        return view('plan_edit',compact('getPlan','getStudyPlanBook'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
