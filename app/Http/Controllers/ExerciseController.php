<?php

namespace App\Http\Controllers;

use App\Models\CalorieCalculator;
use App\Models\Exercise;
use App\Models\ExerciseCategory;
use App\Models\ExerciseType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('exercises');
    }

    public function legs()
    {
        return view('legs-exercises');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function categoryExercises()
    {
        $e_categories = ExerciseCategory::get();
        $e_types = ExerciseType::with('category')->get();
        $weight = CalorieCalculator::where('user_id', Auth::user()->id)->first();
        return view('exercise-categories', compact('e_categories', 'e_types', 'weight'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function types(Request $request, $types)
    {
        $exerciseTypes =  ExerciseType::where('category_id', $types)->get();
        $weight = CalorieCalculator::where('user_id', Auth::user()->id)->first();
        return view('exercises', compact('exerciseTypes', 'weight'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function exerciseName($id)
    {
        $exercises = Exercise::where('type_id', $id)->get();
        return view('the-exercises', compact('exercises'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function edit(Exercise $exercise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exercise $exercise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exercise $exercise)
    {
        //
    }
}
