<?php

namespace App\Http\Controllers;

use App\Models\admin\FitnessClass;
use App\Models\admin\Trainer;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $trainers = Trainer::take(3)->with('specializations')->get();
        $classes = FitnessClass::with('trainer')->take(4)->get();

        return view('welcome', compact('trainers', 'classes'));
    }
}
