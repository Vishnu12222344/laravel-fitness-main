@extends('layouts.nav2')
@section('style-css')
    <link href="{{ asset('css/exercise.css') }}" rel="stylesheet">
@endsection
@section('scripts')
    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            const exerciseCard = document.getElementById('exercise-card');
            exerciseCard.scrollIntoView({ behavior: 'smooth' });
        });
    </script>
    <script src="{{ asset('assets/js/exercises.js') }}"></script>
@endsection
@section('content')
    <div class="container-xxl p-0" style="background-image: url(../assets/imgs/Exercise/dark-bg.jpg); height: 1000px">


    <div  class="exercise-card">
        <main class="exercise-card-content">
            <div id="exercise-card" class="container">
                <div id="slider" class="slider">
                    <ul class="slider__wrap">
                        @foreach($exercises as $key=>$ex)
                        <li class="slider__item {{$key == 0 ? 'active' : ''}}" data-timer-duration="{{ $ex->counter }}">
                            <img src="{{asset($ex->image)}}" alt="Goblet Squad Exercise">
                            <p class="slider__title">{{$ex->name}}</p>
                        </li>
                        @endforeach
                        {{--<li class="slider__item">
                            <img src="{{asset('assets/imgs/ExerciseController/legs/split-squat-exercise.gif')}}" alt="Split Squad ExerciseController">
                            <p class="slider__title">Split Squad</p>
                        </li>
                        <li class="slider__item">
                            <img src="{{asset('assets/imgs/ExerciseController/legs/lunges-exercise.gif')}}" alt="Lunges Squad ExerciseController">
                            <p class="slider__title">Lunges Squad</p>
                        </li>--}}
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
    </div>
@endsection
