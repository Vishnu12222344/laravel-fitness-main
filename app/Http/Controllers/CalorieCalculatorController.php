<?php

namespace App\Http\Controllers;

use App\Models\CalorieCalculator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalorieCalculatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $calories = CalorieCalculator::all();
        return view('calories', compact('calories'));
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
        if (!CalorieCalculator::where('user_id', Auth::user()->id)->first()){
            $calories = CalorieCalculator::create([
                'age' => $request->age,
                'sex' => $request->sex,
                'weight' => $request->weight,
                'height' => $request->inches,
                'activity_level' => $request->activity_level,
                'choose_goal' => $request->gain_loss_amount,
                'cal_result' => $request->cal_result,
                'protein' => $request->protein,
                'fat' => $request->fat,
                'carbohydrates' => $request->carbs,
                'user_id' => Auth::user()->id
            ]);
        }else{
            $calories = CalorieCalculator::where('user_id', Auth::user()->id)->update([
                'age' => $request->age,
                'sex' => $request->sex,
                'weight' => $request->weight,
                'height' => $request->inches,
                'activity_level' => $request->activity_level,
                'choose_goal' => $request->gain_loss_amount,
                'cal_result' => $request->cal_result,
                'protein' => $request->protein,
                'fat' => $request->fat,
                'carbohydrates' => $request->carbs,
                'user_id' => Auth::user()->id
            ]);

        }

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CalorieCalculator  $calorieCalculator
     * @return \Illuminate\Http\Response
     */
    public function show(CalorieCalculator $calorieCalculator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CalorieCalculator  $calorieCalculator
     * @return \Illuminate\Http\Response
     */
    public function edit(CalorieCalculator $calorieCalculator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CalorieCalculator  $calorieCalculator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CalorieCalculator $calorieCalculator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CalorieCalculator  $calorieCalculator
     * @return \Illuminate\Http\Response
     */
    public function destroy(CalorieCalculator $calorieCalculator)
    {
        //
    }
}
