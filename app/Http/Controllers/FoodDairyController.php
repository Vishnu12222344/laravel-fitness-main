<?php

namespace App\Http\Controllers;

use App\Models\AddFood;
use App\Models\Breakfast;
use App\Models\CalorieCalculator;
use App\Models\Dinner;
use App\Models\FoodDairy;
use App\Models\Lunch;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodDairyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foods = AddFood::select()->orderBy('Food_Name', 'asc')->get();
        $dairies = FoodDairy::whereDate('created_at', Carbon::today())->get();
        $dairies_yes = FoodDairy::whereDate('created_at', Carbon::yesterday())->get();
        $units = Unit::select()->get();

        $breakfasts = Breakfast::whereDate('created_at', Carbon::today())
            ->orderBy('created_at', 'desc')
            ->where('user_id', Auth::user()->id)
            ->whereDate('created_at', Carbon::today())
            ->get();
        $br_total_cals = Breakfast::whereDate('created_at', Carbon::today())->where('user_id', Auth::user()->id)->sum('total_calories');

        $lunches = Lunch::whereDate('created_at', Carbon::today())
            ->orderBy('created_at', 'desc')
            ->where('user_id', Auth::user()->id)
            ->whereDate('created_at', Carbon::today())
            ->get();
        $dinners = Dinner::whereDate('created_at', Carbon::today())
            ->orderBy('created_at', 'desc')
            ->where('user_id', Auth::user()->id)
            ->whereDate('created_at', Carbon::today())
            ->get();



        $yes_breakfasts = Breakfast::whereDate('created_at', Carbon::yesterday())->orderBy('created_at', 'desc')->get();
        $yes_br_total_cals = Breakfast::whereDate('created_at', Carbon::yesterday())->where('user_id', Auth::user()->id)->sum('total_calories');

        $yes_lunches = Lunch::whereDate('created_at', Carbon::yesterday())->orderBy('created_at', 'desc')->get();
        $yes_dinners = Dinner::whereDate('created_at', Carbon::yesterday())->orderBy('created_at', 'desc')->get();

        $date = Carbon::today();
        return view('food_dairy',
            compact('foods', 'dairies', 'dairies_yes',
                'units', 'breakfasts', 'lunches', 'dinners',
                'date', 'br_total_cals', 'yes_breakfasts', 'yes_br_total_cals', 'yes_lunches', 'yes_dinners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getData(Request $request)
    {
        $data = $request->route('data');
        $user_id = Auth::user()->id;
        $breakfast = Breakfast::with(['food'])
            ->where('created_at', 'like', $data.'%')
            ->where('user_id', $user_id)
            ->get();
        $lunch = Lunch::with(['food'])
            ->where('created_at', 'like', $data.'%')
            ->where('user_id', $user_id)
            ->get();
        $dinner = Dinner::with(['food'])
            ->where('created_at', 'like', $data.'%')
            ->where('user_id', $user_id)
            ->get();

        $getBrkfastCalories =  Breakfast::whereDate('created_at', $data)->where('user_id', Auth::user()->id)->sum('total_calories');
        $getLunchCalories =    Lunch::whereDate('created_at', $data)->where('user_id', Auth::user()->id)->sum('total_calories');
        $getDinnerCalories =   Dinner::whereDate('created_at', $data)->where('user_id', Auth::user()->id)->sum('total_calories');

        $calorieGoal = CalorieCalculator::where('user_id', Auth::user()->id)->pluck('cal_result');
        $totalConsumedCalories = $getBrkfastCalories + $getLunchCalories + $getDinnerCalories;
//        $remainingCalories = $calorieGoal - $totalConsumedCalories;

        return response()->json([
            'breakfast' => $breakfast,
            'lunch' => $lunch,
            'dinner' => $dinner,

            'getBrkfastCalories' => $getBrkfastCalories,
            'getLunchCalories' => $getLunchCalories,
            'getDinnerCalories' => $getDinnerCalories,
            'calorieGoal' => $calorieGoal,
            'totalConsumedCalories' => $totalConsumedCalories,
        ]);
    }
    public function breakfast()
    {
        return view();
    }

    public function breakfastStore(Request $request)
    {
        try {

            Breakfast::create([
                'food_id' => $request->food_id,
                'serving_size' => $request->serving_size,
                'unit_id' => $request->unit_id,
                'servings_per_container' => $request->servings_per_container,
                'created_at' => $request->created_at,
                'user_id' => Auth::user()->id,
                'total_calories' => $request->serving_size/100 * AddFood::where('id', $request->food_id)->first()->calories
            ]);
            return redirect()->route('dairy')->with(['success' => 'Breakfast\'s has added successfully']);
        }catch (\Exception $exception){
            return $exception;
        }
    }


    public function lunchStore(Request $request)
    {
        try {

            Lunch::create([
                'food_id' => $request->food_id,
                'serving_size' => $request->serving_size,
                'unit_id' => $request->unit_id,
                'servings_per_container' => $request->servings_per_container,
                'created_at' => $request->created_at,
                'user_id' => Auth::user()->id,
                'total_calories' => $request->serving_size*$request->servings_per_container*Unit::where('id', $request->unit_id)->first()->value/100 * AddFood::where('id', $request->food_id)->first()->calories
            ]);
            return redirect()->route('dairy')->with(['success' => 'Lunch\'s food has added successfully']);
        }catch (\Exception $exception){
            return $exception;
        }
    }
    public function dinnerStore(Request $request)
    {
        try {

            Dinner::create([
                'food_id' => $request->food_id,
                'serving_size' => $request->serving_size,
                'unit_id' => $request->unit_id,
                'servings_per_container' => $request->servings_per_container,
                'created_at' => $request->created_at,
                'user_id' => Auth::user()->id,
                'total_calories' => $request->serving_size/100 * AddFood::where('id', $request->food_id)->first()->calories
            ]);
            return redirect()->route('dairy')->with(['success' => 'Dinners\'s food has added successfully']);
        }catch (\Exception $exception){
            return $exception;
        }
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {


            $foods = new FoodDairy();
            $foods->breakfast = $request->breakfast;
            $foods->lunch = $request->lunch;
            $foods->dinner = $request->dinner;
            $foods->user_id = Auth::user()->id;
            $foods->save();
        }catch (\Exception $e) {
            return $e;
        }
        return redirect()->route('dairy');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FoodDairy  $foodDairy
     * @return \Illuminate\Http\Response
     */
    public function show(FoodDairy $foodDairy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FoodDairy  $foodDairy
     * @return \Illuminate\Http\Response
     */
    public function edit(FoodDairy $foodDairy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FoodDairy  $foodDairy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FoodDairy $foodDairy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FoodDairy  $foodDairy
     * @return \Illuminate\Http\Response
     */
    public function destroy(FoodDairy $foodDairy)
    {
        //
    }
}
