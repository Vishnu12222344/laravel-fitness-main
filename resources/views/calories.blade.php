@extends('layouts.nav2')
@section('style-css')
    <link rel="stylesheet" href="{{asset('assets/css/cal.css')}}">
@stop
@section('content')

    <div class="container-xxl p-0" style="background-image: url(../assets/imgs/Exercise/dark-bg.jpg)">

        <!-- Navbar  -->
        <div class="container-xxl position-relative p-0">
            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Calories</h1>
                </div>
            </div>
        </div>
        <!-- Navbar  -->


        <!-- Calculator Start -->
        <div class="container-xxl py-5 px-0 wow fadeInUp" data-wow-delay="0.1s">
            <div class="row g-0">
                <div class="col-md-6">
                    <div class="video"></div>
                </div>
                <div class="col-md-6 bg-dark d-flex align-items-center">
                    <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
                        <h5 class="section-title ff-secondary text-start text-primary fw-normal">Calculate</h5>
                        <h1 class="text-white mb-4">Calculate your calories</h1>
                        <form id="calorie-calculator" action="{{route('calorie.store')}}" method="post">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" name="weight" id="weight" placeholder="Enter your weight" required>

                                        <label for="name">Your Weight</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <input name="weight-unit" type="radio" value="2"> <span style="color: #fff">lbs</span>
                                </div>
                                <div class="col-md-3">
                                    <input name="weight-unit" type="radio" value="1">  <span style="color: #fff">Kg</span>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control"  name="inches" id="inches" placeholder="Enter your height" required>
                                        <label for="inches">Your Height</label>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <input name="height-unit" type="radio" value="2"> <span style="color: #fff">Inches</span>
                                </div>
                                <div class="col-md-3">
                                    <input name="height-unit" type="radio" value="1"> <span style="color: #fff">cm</span>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" name="age" id="age" placeholder="Enter your age in years" required>
                                        <label for="name">Your Age</label>
                                    </div>
                                </div>
                                <div class="col-md-3" style="white-space:nowrap">
                                    <label for="name" style="color: #fff;">Your Gender</label>
                                    <input type="radio" name="sex" value="male" id="male" checked="checked"> <label for="male" style="color: #fff">Male</label>
                                    <input type="radio" name="sex" value="female" id="female"> <label for="female" style="color: #fff">Female</label>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" name="activity_level" id="activity_level">
                                            <option value="1.2">Little to no exercise</option>
                                            <option value="1.375">Light exercise (1−3 days per week)</option>
                                            <option value="1.55">Moderate exercise (3−5 days per week)</option>
                                            <option value="1.725">Heavy exercise (6−7 days per week)</option>
                                            <option value="1.9">Very heavy exercise (twice per day, extra heavy workouts)</option>
                                        </select>
                                        <label for="select1">An Activity Level</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                            <select name="gain_loss_amount" id="gain_loss_amount" class="form-select" required>
                                                <option value="-1000">Lose 2 Pounds per Week</option>
                                                <option value="-750">Lose 1.5 Pounds per Week</option>
                                                <option value="-500">Lose 1 Pounds per Week</option>
                                                <option value="-250">Lose 0.5 Pounds per Week</option>
                                                <option value="0">Stay the Same Weight</option>
                                                <option value="250">Gain 0.5 Pound per Week</option>
                                                <option value="500">Gain 1 Pound per Week</option>
                                                <option value="750">Gain 1.5 Pounds per Week</option>
                                                <option value="1000">Gain 2 Pounds per Week</option>
                                            </select>
                                        <label for="select1">Select a Goal</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" id="submit_cal">Calculate</button>
                                </div>

                                <div id="results"></div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <div id="results"></div>
                                    </div>
                                </div>

                                <div id="results"></div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="number" name="cal_result" class="form-control" id="cal_result" placeholder="Calories result" required readonly>
                                        <label for="name">calculate result</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="number" name="protein" class="form-control" id="protein" placeholder="Protein in grams" required readonly>
                                        <label for="name">Protein (g)</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="number" name="fat" class="form-control" id="fat" placeholder="Fat in grams" required readonly>
                                        <label for="name">Fat (g)</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="number" name="carbs" class="form-control" id="carbs" placeholder="Carbs in grams" required readonly>
                                        <label for="name">Carb (g)</label>
                                    </div>
                                </div>

                                <button class="btn btn-primary w-100 py-3" type="submit">Save</button>

                                <div id="m-results"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- 16:9 aspect ratio -->
                        <div class="ratio ratio-16x9">
                            <iframe class="embed-responsive-item" src="" id="video" allowfullscreen allowscriptaccess="always"
                                    allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>


    {{-- <div class="slider" style="background-image: url({{asset('assets/imgs/home-banner1.jpg')}})">
         <p>Calculate your Calories</p>
     </div>
     <form id="calorie-calculator" action="{{route('calorie.store')}}" method="post">
         @csrf
         <h2 class="form-title">Daily Calories Calculator</h2>
         <label for="age">Age</label>
         <input type="number" name="age" id="age" placeholder="Enter your age in years" required>
         <span></span>
         <div class="radio-group">
             <label for="sex">Sex</label>
             <input type="radio" name="sex" value="male" id="male" checked="checked"> <label for="male">Male</label>
             <input type="radio" name="sex" value="female" id="female"> <label for="female">Female</label>
         </div>
         <div class="row">
             <label>Weight (lbs)</label>
             <div class="col-md-6">
                 <input type="number" name="weight" id="weight" placeholder="Enter your weight" required>
                 <span></span>
             </div>
             <div class="col-md-3">
                 <input name="weight-unit" type="radio" value="2"> lbs
             </div>
             <div class="col-md-3">
                 <input name="weight-unit" type="radio" value="1"> kg
             </div>
         </div>

         <div class="row">
         <label>Height (inches)</label>

         <div class="col-md-6">
         <input type="number" name="inches" id="inches" placeholder="Enter your height" required>
         </div>

         --}}{{--<div class="col-md-3">
             <input name="height-unit" type="radio" value="2"> Inches
         </div>
         <div class="col-md-3">
             <input name="height-unit" type="radio" value="1"> cm
         </div>--}}{{--
         </div>
         <span></span>
         <label>Activity Level</label>
         <select name="activity_level" id="activity_level" required>
             <option value="">Select an Activity Level</option>
             <option value="1.2">Little to no exercise</option>
             <option value="1.375">Light exercise (1−3 days per week)</option>
             <option value="1.55">Moderate exercise (3−5 days per week)</option>
             <option value="1.725">Heavy exercise (6−7 days per week)</option>
             <option value="1.9">Very heavy exercise (twice per day, extra heavy workouts)</option>
         </select>
         <span></span>
         <label>Choose Goal:</label>
         <select name="gain_loss_amount" id="gain_loss_amount" required>
             <option value="">Select a Goal</option>
             <option value="-1000">Lose 2 Pounds per Week</option>
             <option value="-750">Lose 1.5 Pounds per Week</option>
             <option value="-500">Lose 1 Pounds per Week</option>
             <option value="-250">Lose 0.5 Pounds per Week</option>
             <option value="0">Stay the Same Weight</option>
             <option value="250">Gain 0.5 Pound per Week</option>
             <option value="500">Gain 1 Pound per Week</option>
             <option value="750">Gain 1.5 Pounds per Week</option>
             <option value="1000">Gain 2 Pounds per Week</option>
         </select>
         <span></span>
         <button type="reset">Reset</button>
         <button id="submit_cal">Calculate</button>
         <div id="results"></div>

     <input type="number" name="cal_result" id="cal_result" placeholder="Calories result" required readonly>


         <label>Protein (g)</label>
         <input type="number" name="protein" id="protein" placeholder="Protein in grams" required readonly>
         <span></span>
         <label>Fat (g)</label>
         <input type="number" name="fat" id="fat" placeholder="Fat in grams" required readonly>
         <span></span>
         <label>op (g)</label>
         <input type="number" name="carbs" id="carbs" placeholder="Carbs in grams" required readonly>
         <span></span>

         <button type="submit">Save</button>

         <div id="m-results"></div>
     </form>--}}
    @endsection
    @section('scripts')
    <script>
    let weightUnit = document.querySelectorAll("input[name='weight-unit']");
    let heightUnit = document.querySelectorAll("input[name='height-unit']");

    $(document).on('click', '#submit_cal', function (e) {
        e.preventDefault();
        calcDailyCals();
        console.log('hello')
    });




    function calcDailyCals(){
        let age = parseInt($('#age').val());
        let sex = $('input[name="sex"]:checked').val();

        let weight = parseFloat($('#weight').val()) * 0.453592;


        let height;


        heightUnit.forEach(function(unit) {
            if(unit.checked) {
                if (unit.value === "1") {
                    height = parseFloat($("#inches").val());
                } else if (unit.value === "2") {
                    height = parseFloat($("#inches").val()) * 2.54;
                }
            }

        });

        console.log(height)


        let activity = parseFloat($('#activity_level').val());
        let goal = parseInt($('#gain_loss_amount').val());

        console.log(heightUnit)

        let result;

        weightUnit.forEach(function(unit) {
            if(unit.checked) {
                if (unit.value === "1") {
                    if (sex === 'male') {
                        result = (88.362 + (13.397 * weight) + (4.799 * height) - (5.677 * age)) * activity;
                    } else {
                        result = (447.593 + (9.247 * weight) + (3.098 * height) - (4.33 * age)) * activity;
                    }
                } else if (unit.value === "2") {
                    if (sex === 'male') {
                        result = (88.362 + (13.397 * weight * 0.453592) + (4.799 * height) - (5.677 * age)) * activity;
                    } else {
                        result = (447.593 + (9.247 * weight * 0.453592) + (3.098 * height) - (4.33 * age)) * activity;
                    }
                }
            }
        });



        result = Math.round(result + goal);

        calcDailyMacros(result);

        $('#results').fadeOut('fast',function(){
            $(this).html('<h3>Estimated Daily Calories: ' + result + '</h3>').fadeIn('fast');
        });


        function calcDailyMacros(result){
            $('#cal_result').val(result)
            let carbs = (result * .4) /4;
            let protein = (result * .3) /4;
            let fat = (result * .3) / 9;

            $('#carbs').val(Math.round(carbs));
            $('#protein').val(Math.round(protein));
            $('#fat').val(Math.round(fat));
        }


    }

    </script>
    @endsection
