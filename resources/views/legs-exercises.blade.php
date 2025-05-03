@extends('layouts.app')
@section('style-css')
    <link href="{{ asset('css/exercise.css') }}" rel="stylesheet">
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/exercises.js') }}"></script>
@endsection
@section('content')
    <div class="exercise-card">
        <header class="exercise-card-head">
            <h2 class="ex-card-title">Leg Exercises</h2>
        </header>
        <main class="exercise-card-content">
            <div class="container">
                <div id="slider" class="slider">
                    <ul class="slider__wrap">
                        <li class="slider__item active">
                            <img src="{{asset('assets/imgs/ExerciseController/legs/goblet-squad.gif')}}" alt="Goblet Squad Exercise">
                            <p class="slider__title">Goblet Squad</p>
                        </li>
                        <li class="slider__item">
                            <img src="{{asset('assets/imgs/ExerciseController/legs/split-squat-exercise.gif')}}" alt="Split Squad Exercise">
                            <p class="slider__title">Split Squad</p>
                        </li>
                        <li class="slider__item">
                            <img src="{{asset('assets/imgs/ExerciseController/legs/lunges-exercise.gif')}}" alt="Lunges Squad Exercise">
                            <p class="slider__title">Lunges Squad</p>
                        </li>
                    </ul>
                    <div class="slider__countdown countdown-wrap">
                        <a href="#" class="slider__prev" >&#8810;</a>
                        <svg viewBox="0 0 40 40">
                            <circle r="18" cx="20" cy="20"></circle>
                        </svg>
                        <div id="timer" class="slider__timer"></div>
                        <a href="#" class="slider__next" >&#8811;</a>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
