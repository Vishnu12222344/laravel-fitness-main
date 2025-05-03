<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CalorieCalculator;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'user_name' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'age' => ['required', 'integer'],
            'sex' => ['required', 'in:male,female'],
            'weight' => ['required', 'numeric'],
            'height' => ['required', 'numeric'],
            'activity_level' => ['required', 'numeric'],
            'gain_loss_amount' => ['required', 'numeric'],
            'height-unit' => ['required', 'in:1,2'], // 1 = cm, 2 = inch
            'weight-unit' => ['required', 'in:1,2'], // 1 = kg, 2 = lbs
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Convert height (if in inches) to cm
        if ($data['height-unit'] == 2) {
            $data['height'] *= 2.54;
        }

        // Convert weight (if in lbs) to kg
        if ($data['weight-unit'] == 2) {
            $data['weight'] *= 0.453592;
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'user_name' => $data['user_name'],
            'password' => Hash::make($data['password']),
        ]);

        $calorieCalculator = new CalorieCalculator([
            'age' => $data['age'],
            'sex' => $data['sex'],
            'weight' => $data['weight'],
            'height' => $data['height'],
            'activity_level' => $data['activity_level'],
            'choose_goal' => $data['gain_loss_amount'],
        ]);

        $result = ($calorieCalculator->sex === 'male')
            ? (88.362 + (13.397 * $calorieCalculator->weight) + (4.799 * $calorieCalculator->height) - (5.677 * $calorieCalculator->age)) * $calorieCalculator->activity_level
            : (447.593 + (9.247 * $calorieCalculator->weight) + (3.098 * $calorieCalculator->height) - (4.33 * $calorieCalculator->age)) * $calorieCalculator->activity_level;

        $calorieCalculator->cal_result = $result + $calorieCalculator->choose_goal;
        $calorieCalculator->carbohydrates = (int) round(($result * 0.4) / 4);
        $calorieCalculator->protein = (int) round(($result * 0.3) / 4);
        $calorieCalculator->fat = (int) round(($result * 0.3) / 9);

        $user->calorieCalculator()->save($calorieCalculator);

        return $user;
    }

    /**
     * Customize the redirection path after registration.
     *
     * @return string
     */
    protected function redirectTo()
    {
        return '/profile/' . Auth::user()->user_name;
    }
}
