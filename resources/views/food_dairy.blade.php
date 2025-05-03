@extends('layouts.nav2')
@section('style-css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
    /* Dropdown Button */
    .dropbtn {
        background-color: #04AA6D;
        color: white;
        padding: 16px;
        font-size: 16px;
        border: none;
        cursor: pointer;
    }

    /* Dropdown button on hover & focus */
    .dropbtn:hover, .dropbtn:focus {
        background-color: #3e8e41;
    }

    /* The search field */
    #inputSearch {
        box-sizing: border-box;
        background-image: url('http://127.0.0.1:8000/assets/imgs/icons/searchicon.png');
        background-position: 14px 12px;
        background-repeat: no-repeat;
        font-size: 16px;
        padding: 14px 20px 12px 45px;
        border: none;
        border-bottom: 1px solid #ddd;
        width: 497px;
    }

    /* The search field when it gets focus/clicked on */
    #inputSearch:focus {outline: 3px solid #ddd;}

    /* The container <div> - needed to position the dropdown content */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    /* Dropdown Content (Hidden by Default) */
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f6f6f6;
        width: 500px;
        height: 150px;
        border: 1px solid #ddd;
        z-index: 1;
        overflow: scroll;
    }

    /* Links inside the dropdown */
    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    /* Change color of dropdown links on hover */
    .dropdown-content a:hover {background-color: #f1f1f1}

    /* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */

    #form-food-div{
        background-color: #f6f6f6;
        height: 250px;
        width: 500px;
        position: relative;
        padding: 20px;
    }
    #foodname{
        font-size: 30px;
        text-align: center;

    }
</style>
    @stop
@section('content')
    <div class="container-xxl p-0" style="background-image: url(../assets/imgs/Exercise/dark-bg.jpg)">

        <!-- Navbar  -->
        <div class="container-xxl position-relative p-0">
            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Food Dairy</h1>
                </div>
            </div>
        </div>
        <!-- Navbar  -->

        <div class="container">
    @include('alerts.success')
    @include('alerts.errors')

            <div id="progress"></div>


<div class="row">
    <div class="col-md-6">
        <div id="date_controls">
    <span class="date">
        <a class="prev" href="#">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <time id="current-date"></time>
        <a class="next" href="#">
            <i class="fa-solid fa-arrow-right"></i>
        </a>
    </span>
            <input type="hidden" id="date_selector" value=""/>
            <i class="icon-calendar" id="datepicker-trigger"></i>
        </div>

        <i  id="myCalendar" class="fa-solid fa-calendar-days" style="color:#FFF; font-size:25px"></i>

    </div>
    <div class="col-md-6 my-4">
        <h4 class="myCalories" id="myCalories" style="color: #FFF;"></h4>

    </div>
</div>


            {{--
                    * table of units g=1 kg=1/1000 oz = .....
                    * form of breakfast>>etc have relationship with food
                    * add unit relationship to breakfast table
                    * put many of (Servings per container) required table and has relationship with units
            --}}
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a type="button" class="btn btn-pink" id="yesterday" href="#">Yesterday</a>
            <a type="button" class="btn btn-pink" id="today" href="#">Today</a>
            <a type="button" class="btn btn-pink" id="tomorrow" href="#">Tomorrow</a>
        </div>

{{--
        <form action="{{route('dairy.store')}}" method="post" style="all: unset !important; ">
            @csrf
            <div class="row justify-content-center">

        <label for="breakfast">Choose Foods for breakfast:</label>

        <select id="breakfast" name="breakfast">
            @foreach($foods as $food)
            <option value="{{$food->id}}">{{$food->Food_Name}}</option>
            @endforeach
        </select>
        <label for="lunch">Choose Foods for lunch:</label>

        <select id="lunch" name="lunch">
            @foreach($foods as $food)
                <option value="{{$food->id}}">{{$food->Food_Name}}</option>
            @endforeach
        </select>

        <label for="dinner">Choose Foods for dinner:</label>

        <select id="dinner" name="dinner">
            @foreach($foods as $food)
                <option value="{{$food->id}}">{{$food->Food_Name}}</option>
            @endforeach
        </select>
                <button type="submit" class="btn btn-pink">Add</button>
            </div>
        </form>
--}}

   <div class="col-md-12">


       <table class="table" id="tod_tr_1" style="display: table; color:#fffaea">
            <thead>
            <tr>
                <th scope="col">
                    <span id="getBrkfastCalories">BreakFast ({{\App\Helpers\Meals::getBrkfastCalories()}} cal)</span>

                    <a type="button" class="btn btn-pink" id="breakfastBtn" href="#">+</a>
                </th>
                <th scope="col">
                    Serving Size
                </th>
                <th scope="col">
                    Calories
                </th>
            </tr>
            </thead>
            <tbody id="bf">
            @foreach($breakfasts as $breakfast)
                <tr>
                    <td>{{$breakfast->food->Food_Name}}({{$breakfast->food->calories}} cal/100g)</td>
                    <td>{{$breakfast->serving_size}}{{$breakfast->unit->abbr}} x {{$breakfast->servings_per_container}}</td>
                    <td>{{$breakfast->total_calories}} kcal</td>
                </tr>
            @endforeach

            <tr id="data-container"></tr>
            </tbody>
        </table>
        <table class="table" id="tod_tr_2" style="display: table; color:#fffaea">
            <thead>
            <tr>
                <th scope="col">
                    <span id="getLunchCalories">Lunch ({{\App\Helpers\Meals::getLunchCalories()}} cal)</span>
                    <a type="button" class="btn btn-pink" id="lunchBtn" href="#">+</a>
                </th>
                <th scope="col">
                    Serving Size
                </th>
                <th scope="col">
                    Calories
                </th>
            </tr>
            </thead>
            <tbody id="lu">
            @foreach($lunches as $lunch)
                <tr>
                    <td>{{$lunch->food->Food_Name}}({{$lunch->food->calories}} cal/100g)</td>
                    <td>{{$lunch->serving_size}}{{$lunch->unit->abbr}} x {{$lunch->servings_per_container}}</td>
                    <td>{{$lunch->total_calories}} kcal</td>
                </tr>
            @endforeach


            </tbody>
        </table>
        <table class="table" id="tod_tr_3" style="display: table; color:#fffaea">
            <thead>
            <tr>
                <th scope="col">
                    <span id="getDinnerCalories"> Dinner ({{\App\Helpers\Meals::getDinnerCalories()}} cal) </span>
                    <a type="button" class="btn btn-pink" id="dinnerBtn" href="#">+</a>
                </th>
                <th scope="col">
                    Serving Size
                </th>
                <th scope="col">
                    Calories
                </th>
            </tr>
            </thead>
            <tbody id="din">
            @foreach($dinners as $dinner)
                <tr>
                    <td>{{$dinner->food->Food_Name}}({{$dinner->food->calories}} cal/100g)</td>
                    <td>{{$dinner->serving_size}}{{$dinner->unit->abbr}} x {{$dinner->servings_per_container}}</td>
                    <td>{{$dinner->total_calories}} kcal</td>
{{--                    <td>{{$dinner->serving_size * $dinner->servings_per_container/100 * $dinner->food->calories}} kcal</td>--}}
                </tr>
            @endforeach


            </tbody>
        </table>

        <table class="table" id="yes_tr_1" style="display: none; color:#fffaea">
            <thead>
            <tr>
                <th scope="col">

                    BreakFast ({{\App\Helpers\Meals::getYesBrkfastCalories()}} cal)

                    <a type="button" class="btn btn-pink" id="breakfastBtn" href="#">+</a>
                </th>
                <th scope="col">
                    Serving Size
                </th>
                <th scope="col">
                    Calories
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($yes_breakfasts as $breakfast)
                <tr>
                    <td>{{$breakfast->food->Food_Name}}({{$breakfast->food->calories}} cal/100g)</td>
                    <td>{{$breakfast->serving_size}}{{$breakfast->unit->abbr}} x {{$breakfast->servings_per_container}}</td>
                    <td>{{$breakfast->total_calories}} kcal</td>
                </tr>
            @endforeach


            </tbody>
        </table>
        <table class="table" id="yes_tr_2" style="display: none; color:#fffaea">
            <thead>
            <tr>
                <th scope="col">
                    Lunch ({{\App\Helpers\Meals::getYesLunchCalories()}} cal)
                    <a type="button" class="btn btn-pink" id="lunchBtn" href="#">+</a>
                </th>
                <th scope="col">
                    Serving Size
                </th>
                <th scope="col">
                    Calories
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($yes_lunches as $lunch)
                <tr>
                    <td>{{$lunch->food->Food_Name}}({{$lunch->food->calories}} cal/100g)</td>
                    <td>{{$lunch->serving_size}}{{$lunch->unit->abbr}} x {{$lunch->servings_per_container}}</td>
                    <td>{{$lunch->total_calories}} kcal</td>
                </tr>
            @endforeach


            </tbody>
        </table>
        <table class="table" id="yes_tr_3" style="display: none">
            <thead>
            <tr>
                <th scope="col">
                    Dinner ({{\App\Helpers\Meals::getYesDinnerCalories()}} cal)
                    <a type="button" class="btn btn-pink" id="dinnerBtn" href="#">+</a>
                </th>
                <th scope="col">
                    Serving Size
                </th>
                <th scope="col">
                    Calories
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($yes_dinners as $dinner)
                <tr>
                    <td>{{$dinner->food->Food_Name}}({{$dinner->food->calories}} cal/100g)</td>
                    <td>{{$dinner->serving_size}}{{$dinner->unit->abbr}} x {{$dinner->servings_per_container}}</td>
                    <td>{{$dinner->total_calories}} kcal</td>
{{--                    <td>{{$dinner->serving_size * $dinner->servings_per_container/100 * $dinner->food->calories}} kcal</td>--}}
                </tr>
            @endforeach


            </tbody>
        </table>


    </div>

<div class="container">
 <div class="row">
   <div class="col-md-6">
        <div class="dropdown" style="margin-bottom: 200px">
            <input type="text" placeholder="Search.." id="inputSearch" style="display: none" onkeyup="searchFunction()">
            <div id="myFoodList" class="dropdown-content" style="display: none">
                @foreach($foods as $food)
                    <a href="#" id="foody" data-id="{{$food->id}}"  onclick="myfun(this)">{{$food->Food_Name}}</a>
                @endforeach
            </div>
        </div>
   </div>

   <div class="col-md-6">
        <div id="form-food-div" style="display: none">
            <form id="form-meals" action="" method="post">
                @csrf
                <p id="foodname"></p>
                <div class="row">
                    <div class="col-md-12">
                        <input name="food_id" id="food_id" hidden readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="">Serving Size</label>
                        <input type="number" name="serving_size">
                    </div>
                    <div class="col-md-6" style="margin-top: 27px">
                        <label for="">Unit</label>
                        <select id="units" name="unit_id">
                            @foreach($units as $unit)
                                <option value="{{$unit->id}}">{{$unit->abbr}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="">Servings per container</label>
                        <input name="servings_per_container" type="number">
                    </div>

                    <div class="col-md-6">
                        <label for="">Date</label>
                        <input id="created_at" name="created_at">
                    </div>
                </div>
                <button type="submit" class="btn btn-pink my-3" id="add-f" href="#"></button>
            </form>
        </div>
      </div>
</div>
</div>
        <div class="col-md-12 my-5">
            <canvas id="myChart"></canvas>
        </div>


        @endsection
@section('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/progressbar.js@1.0.0/dist/progressbar.min.js"></script>

            <script>
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['OK', 'WARNING', 'CRITICAL', 'UNKNOWN'],
                    datasets: [{
                        label: '# of Tomatoes',
                        data: [12, 19, 3, 5],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    //cutoutPercentage: 40,
                    responsive: false,

                }
            });
        </script>


            <script>
        const yesterday = document.getElementById('yesterday');
        const today = document.getElementById('today');
        const tomorrow = document.getElementById('tomorrow');

        const breakfastBtn = document.getElementById('breakfastBtn');
        const lunchBtn = document.getElementById('lunchBtn');
        const dinnerBtn = document.getElementById('dinnerBtn');
        const addF = document.getElementById('add-f');

        const food_list = document.getElementById("myFoodList")

        const tod_tr_1 = document.getElementById('tod_tr_1');
        const tod_tr_2 = document.getElementById('tod_tr_2');
        const tod_tr_3 = document.getElementById('tod_tr_3');

        const yes_tr_1 = document.getElementById('yes_tr_1');
        const yes_tr_2 = document.getElementById('yes_tr_2');
        const yes_tr_3 = document.getElementById('yes_tr_3');

        const prevArrow = document.querySelector('.prev');
        const nextArrow = document.querySelector('.next');

        var a = document.getElementsByTagName("a")
        var inpSearch = document.getElementById("inputSearch");
        var foodFormDiv = document.getElementById("form-food-div");
        var mealForm = document.getElementById("form-meals");
        var foodServing = document.getElementById('myFormId');



        /*scroll to this table on load the page*/
        window.onload = function() {
            if(tod_tr_1) {
                window.scrollTo({
                    top: tod_tr_1.offsetTop,
                    behavior: "smooth"
                });
            }
        };

        /*get Calendar*/
        const myCalendar = flatpickr("#myCalendar", {
            dateFormat: "Y-m-d",
            onChange: function(selectedDates, dateStr, instance) {
                const baseUrl = "http://127.0.0.1:8000/food-dairy";
                const dateParam = "date=" + dateStr;
                const newUrl = baseUrl + "?" + dateParam;
                window.location.href = newUrl;
            }
        });



        /*** Get the url params ***/
        const numberOfDays = 1;
        let currentDate = new Date(); //Wed Apr 12 2023 15:34:05 GMT+0200 (Eastern European Standard Time)


        // Converting this date to a string in the format "weekday, month day, year" using the toLocaleDateString()
        const currentDateString = currentDate.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
        //currentDateString => Wednesday, April 12, 2023




        // Get the prev and next arrow elements


        let prevDateString;
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('date')) {
            prevDateString = urlParams.get('date');
        }

        /*** To retrieve the item that was created at the time specified in the URL ***/

        // 1- if we retrieve the items on load the window

        const queryParams = new URLSearchParams(window.location.search);
        const dateParam = queryParams.get('date');
        console.log(window.location.search);//?date=2023-04-11
        const url = new URL(location.href);
        console.log(url.searchParams.get("date")) //2023-04-11
        console.log(location.href.includes(dateParam));

        const paramDate = new Date(dateParam);
        var displayDate = paramDate.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });


        if (location.href.includes(dateParam)) {
            window.onload = function () {
                document.getElementById('current-date').textContent = displayDate
                console.log(prevDateString)
                fetch(location.href)
                    .then(response => response.text())
                    .then(data => {
                        while(url.searchParams.get("date")) {
                            url.searchParams.delete("date");
                        }
                        url.searchParams.append('date', prevDateString);
                        window.history.pushState({}, "", url.href);
                    })
                    .catch(error => {
                        console.log(error);
                    });

                var currentUrl = '/food-diary/'+prevDateString;
                $.ajax({
                    type: "GET",
                    url: currentUrl,
                    data: {date: prevDateString},
                    success: function (data) {
                        console.log(data)
                        console.log('hi')
                        let currentPath = window.location.pathname;
                        let currentLanguage = currentPath.split('/')[1];
                        console.log(currentLanguage)
                        let output = '';
                        for (let i = 0; i < data.breakfast.length; i++) {
                            let foodName;
                            if(currentLanguage === 'en'){
                                foodName = data.breakfast[i].food.Food_Name.en;
                            }else{
                                foodName = data.breakfast[i].food.Food_Name.ar;
                            }
                            output += `
             <tr>
            <td> ${foodName} + </td>
            <td> ${data.breakfast[i].serving_size}g x ${data.breakfast[i].servings_per_container}</td>
            <td> ${data.breakfast[i].total_calories} kcal </td>
            </tr>
        `;
                        }
                        document.querySelector('#bf').innerHTML = output;
                        document.querySelector('#getBrkfastCalories').innerHTML = 'BreakFast ('+ data.getBrkfastCalories + 'cal)';

                        let lunchoutput = '';
                        for (let i = 0; i < data.lunch.length; i++) {
                            let foodName;
                            if(currentLanguage === 'en'){
                                foodName = data.lunch[i].food.Food_Name.en;
                            }else{
                                foodName = data.lunch[i].food.Food_Name.ar;
                            }
                            lunchoutput += `
             <tr>
            <td> ${foodName} + </td>
            <td> ${data.lunch[i].serving_size}g x ${data.lunch[i].servings_per_container}</td>
            <td> ${data.lunch[i].total_calories} kcal </td>
            </tr>
        `;
                        }
                        document.querySelector('#lu').innerHTML = lunchoutput;
                        document.querySelector('#getLunchCalories').innerHTML = 'Lunch ('+ data.getLunchCalories + 'cal)';


                        let dinneroutput = '';
                        for (let i = 0; i < data.dinner.length; i++) {
                            let foodName;
                            if(currentLanguage === 'en'){
                                foodName = data.dinner[i].food.Food_Name.en;
                            }else{
                                foodName = data.dinner[i].food.Food_Name.ar;
                            }
                            dinneroutput += `
             <tr>
            <td> ${foodName} + </td>
            <td> ${data.dinner[i].serving_size}g x ${data.dinner[i].servings_per_container}</td>
            <td> ${data.dinner[i].total_calories} kcal </td>
            </tr>
        `;
                        }
                        document.querySelector('#din').innerHTML = dinneroutput;
                        document.querySelector('#getDinnerCalories').innerHTML = 'Dinner ('+ data.getDinnerCalories + 'cal)';


                        var remainingCalories = (data.calorieGoal - data.totalConsumedCalories).toFixed(2)
                        document.querySelector('#myCalories').innerHTML = 'Goal:'+ data.calorieGoal +
                            ' consumed:' + data.totalConsumedCalories + ' remaining:' + remainingCalories;

                    }
                });
            };
        }else{
            // belongs to this element ==> <time id="current-date"></time>
            document.getElementById('current-date').textContent = currentDateString;
        }

        // 2- if we retrieve the items after clicking on .prev
        document.querySelector('.prev').addEventListener('click', (event) => {
            event.preventDefault();

            //The current date [when press prev button]
            const prevDate = new Date(currentDate.getTime() - (1 * 24 * 60 * 60 * 1000));
            currentDate = prevDate;


            /* Code converts the previous date in prevDate to an ISO string format and
            selects the first 10 characters to get the date portion in the format "YYYY-MM-DD".*/

            const prevDateString = prevDate.toISOString().substring(0,10);

            const url = new URL(location.href);
            console.log(url) // = URL {origin: 'http://127.0.0.1:8000', protocol: 'http:', username: '', password: '', host: '127.0.0.1:8000', …}

            url.searchParams.append('date', prevDateString);
            console.log(url.href)
            //retrieve http://127.0.0.1:8000/food-dairy?date=04%2F12%2F2023&date=2023-04-11

            let href = url.href
            console.log(href)
            //http://127.0.0.1:8000/food-dairy?date=2023-04-11&date=2023-04-11

            console.log(location.href)
            //http://127.0.0.1:8000/food-dairy?date=2023-04-11

            console.log(url.searchParams.get("date")) //2023-04-11

            const paramDate = new Date(prevDateString);
            var displayDate = paramDate.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });


            document.getElementById('current-date').textContent = displayDate
            document.querySelector('#created_at').value = prevDateString;

            fetch(location.href)
                .then(response => response.text())
                .then(data => {
                    while(url.searchParams.get("date")) {
                        url.searchParams.delete("date");
                    }
                    url.searchParams.append('date', prevDateString);
                    window.history.pushState({}, "", url.href);
                })
                .catch(error => {
                    console.log(error);
                });

            var currentUrl = '/food-diary/'+prevDateString;
            $.ajax({
                type: "GET",
                url: currentUrl,
                data:{date:prevDateString},
                success: function(data) {
                    console.log(data);
                    console.log(currentUrl)
                    let currentPath = window.location.pathname;
                    let currentLanguage = currentPath.split('/')[1];
                    console.log(currentLanguage)
                    let output = '';
                    for (let i = 0; i < data.breakfast.length; i++) {
                        let foodName;
                        if(currentLanguage === 'en'){
                            foodName = data.breakfast[i].food.Food_Name.en;
                        }else{
                            foodName = data.breakfast[i].food.Food_Name.ar;
                        }
                        output += `
             <tr>
            <td> ${foodName} + </td>
            <td> ${data.breakfast[i].serving_size}g x ${data.breakfast[i].servings_per_container}</td>
            <td> ${data.breakfast[i].total_calories} kcal </td>
            </tr>
        `;
                    }
                    document.querySelector('#bf').innerHTML = output;
                    document.querySelector('#getBrkfastCalories').innerHTML = 'BreakFast ('+ data.getBrkfastCalories + 'cal)';


                    let lunchoutput = '';
                    for (let i = 0; i < data.lunch.length; i++) {
                        let foodName;
                        if(currentLanguage === 'en'){
                            foodName = data.lunch[i].food.Food_Name.en;
                        }else{
                            foodName = data.lunch[i].food.Food_Name.ar;
                        }
                        lunchoutput += `
             <tr>
            <td> ${foodName} + </td>
            <td> ${data.lunch[i].serving_size}g x ${data.lunch[i].servings_per_container}</td>
            <td> ${data.lunch[i].total_calories} kcal </td>
            </tr>
        `;
                    }
                    document.querySelector('#lu').innerHTML = lunchoutput;
                    document.querySelector('#getLunchCalories').innerHTML = 'Lunch ('+ data.getLunchCalories + 'cal)';


                    let dinneroutput = '';
                    for (let i = 0; i < data.dinner.length; i++) {
                        let foodName;
                        if(currentLanguage === 'en'){
                            foodName = data.dinner[i].food.Food_Name.en;
                        }else{
                            foodName = data.dinner[i].food.Food_Name.ar;
                        }
                        dinneroutput += `
             <tr>
            <td> ${foodName} + </td>
            <td> ${data.dinner[i].serving_size}g x ${data.dinner[i].servings_per_container}</td>
            <td> ${data.dinner[i].total_calories} kcal </td>
            </tr>
        `;
                    }
                    document.querySelector('#din').innerHTML = dinneroutput;
                    document.querySelector('#getDinnerCalories').innerHTML = 'Dinner ('+ data.getDinnerCalories + 'cal)';


                    var remainingCalories = (data.calorieGoal - data.totalConsumedCalories).toFixed(2)
                    document.querySelector('#myCalories').innerHTML = 'Goal:'+ data.calorieGoal +
                        ' consumed:' + data.totalConsumedCalories + ' remaining:' + remainingCalories;




                }
            });

        });
        document.querySelector('.next').addEventListener('click', (event) => {
            event.preventDefault();

            //The current date [when press prev button]
            const nextDate = new Date(currentDate.getTime() + (1 * 24 * 60 * 60 * 1000));
            currentDate = nextDate;


            /* Code converts the previous date in nextDate to an ISO string format and
            selects the first 10 characters to get the date portion in the format "YYYY-MM-DD".*/

            const nextDateString = nextDate.toISOString().substring(0,10);

            const url = new URL(location.href);
            console.log(url) // = URL {origin: 'http://127.0.0.1:8000', protocol: 'http:', username: '', password: '', host: '127.0.0.1:8000', …}

            url.searchParams.append('date', nextDateString);
            console.log(url.href)
            //retrieve http://127.0.0.1:8000/food-dairy?date=04%2F12%2F2023&date=2023-04-11

            let href = url.href
            console.log(href)
            //http://127.0.0.1:8000/food-dairy?date=2023-04-11&date=2023-04-11

            console.log(location.href)
            //http://127.0.0.1:8000/food-dairy?date=2023-04-11

            console.log(url.searchParams.get("date")) //2023-04-11

            const paramDate = new Date(nextDateString);
            var displayDate = paramDate.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });


            document.getElementById('current-date').textContent = displayDate
            document.querySelector('#created_at').value = nextDateString;
//

            fetch(location.href)
                .then(response => response.text())
                .then(data => {
                    while(url.searchParams.get("date")) {
                        url.searchParams.delete("date");
                    }
                    url.searchParams.append('date', nextDateString);
                    window.history.pushState({}, "", url.href);
                })
                .catch(error => {
                    console.log(error);
                });

            var currentUrl = '/food-diary/'+nextDateString;
            $.ajax({
                type: "GET",
                url: currentUrl,
                data:{date:nextDateString},
                success: function(data) {
                    console.log(data);
                    console.log(data)
                    let currentPath = window.location.pathname;
                    let currentLanguage = currentPath.split('/')[1];
                    console.log(currentLanguage)
                    let output = '';
                    for (let i = 0; i < data.breakfast.length; i++) {
                        let foodName;
                        if(currentLanguage === 'en'){
                            foodName = data.breakfast[i].food.Food_Name.en;
                        }else{
                            foodName = data.breakfast[i].food.Food_Name.ar;
                        }
                        output += `
             <tr>
            <td> ${foodName} + </td>
            <td> ${data.breakfast[i].serving_size}g x ${data.breakfast[i].servings_per_container}</td>
            <td> ${data.breakfast[i].total_calories} kcal </td>
            </tr>
        `;
                    }


                    document.querySelector('#bf').innerHTML = output;
                   document.querySelector('#getBrkfastCalories').innerHTML = 'BreakFast ('+ data.getBrkfastCalories + 'cal)';


                    let lunchoutput = '';
                    for (let i = 0; i < data.lunch.length; i++) {
                        let foodName;
                        if(currentLanguage === 'en'){
                            foodName = data.lunch[i].food.Food_Name.en;
                        }else{
                            foodName = data.lunch[i].food.Food_Name.ar;
                        }
                        lunchoutput += `
             <tr>
            <td> ${foodName} + </td>
            <td> ${data.lunch[i].serving_size}g x ${data.lunch[i].servings_per_container}</td>
            <td> ${data.lunch[i].total_calories} kcal </td>
            </tr>
        `;
                    }
                    document.querySelector('#lu').innerHTML = lunchoutput;
                    document.querySelector('#getLunchCalories').innerHTML = 'Lunch ('+ data.getLunchCalories + 'cal)';


                    let dinneroutput = '';
                    for (let i = 0; i < data.dinner.length; i++) {
                        let foodName;
                        if(currentLanguage === 'en'){
                            foodName = data.dinner[i].food.Food_Name.en;
                        }else{
                            foodName = data.dinner[i].food.Food_Name.ar;
                        }
                        dinneroutput += `
             <tr>
            <td> ${foodName} + </td>
            <td> ${data.dinner[i].serving_size}g x ${data.dinner[i].servings_per_container}</td>
            <td> ${data.dinner[i].total_calories} kcal </td>
            </tr>


        `;
                    }
                    document.querySelector('#din').innerHTML = dinneroutput;
                    document.querySelector('#getDinnerCalories').innerHTML = 'Dinner ('+ data.getDinnerCalories + 'cal)';


                    var remainingCalories = (data.calorieGoal - data.totalConsumedCalories).toFixed(2)
                    document.querySelector('#myCalories').innerHTML = 'Goal:'+ data.calorieGoal +
                        ' consumed:' + data.totalConsumedCalories + ' remaining:' + remainingCalories;

                }
            });

        });






        /*yesterday.addEventListener('click', () => {

            if (yes_tr.style.display === 'none') {
                // 👇️ this SHOWS the form
                yes_tr.style.display = 'table'
                tod_tr.style.display = 'none';
            }
        });*/


        today.addEventListener('click', () => {

            if (tod_tr_1.style.display === 'none' && tod_tr_2.style.display === 'none' && tod_tr_3.style.display === 'none') {
                // 👇️ this SHOWS the form
                tod_tr_1.style.display = 'table';
                tod_tr_2.style.display = 'table';
                tod_tr_3.style.display = 'table';

                yes_tr_1.style.display = 'none';
                yes_tr_2.style.display = 'none';
                yes_tr_3.style.display = 'none';

            }
        });



        function searchFunction() {
            var search_input, serFoodUpCase, ul, li, a_food, i;
            search_input = inpSearch
            serFoodUpCase = search_input.value.toUpperCase();
            foodlist = food_list;
            a_food = foodlist.getElementsByTagName("a");
            for (i = 0; i < a_food.length; i++) {
                foodLinkValue = a_food[i].textContent || a_food[i].innerText;
                if (foodLinkValue.toUpperCase().indexOf(serFoodUpCase) > -1) {
                    a_food[i].style.display = "";
                } else {
                    a_food[i].style.display = "none";
                }
            }
        }

        window.myfun = function(obj) {
            document.getElementById("foodname").innerHTML = obj.innerHTML;
        }


        $(function(){
            $(a).click(function(){
                var foodid = $(this).attr('data-id');
                $('#food_id').val(foodid);
                var foodid = null;
            });
        });




        // Get dates
        function getToday(date = new Date()) {
            const today_d = new Date(date.getTime())
            today_d.setDate(date.getDate())

            var dd = String(today_d.getDate()).padStart(2, '0');
            var mm = String(today_d.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today_d.getFullYear();
            let today = dd + '-' + mm + '-' + yyyy;

            return today
        }
        function getPreviousDay(date = new Date()) {
            const previous_d = new Date(date.getTime());
            previous_d.setDate(date.getDate() - 1)

            let dd = String(previous_d.getDate()).padStart(2, '0');
            let mm = String(previous_d.getMonth() + 1).padStart(2, '0')
            let yyyy = previous_d.getFullYear()

            let previouss = dd + '-' + mm + '-' + yyyy;

            return previouss
        }
        function getNextDay(date = new Date()) {
            const next_d = new Date(date.getTime());
            next_d.setDate(date.getDate() + 1)

            let dd = String(next_d.getDate()).padStart(2, '0');
            let mm = String(next_d.getMonth() + 1).padStart(2, '0')
            let yyyy = next_d.getFullYear()

            let nextt = dd + '-' + mm + '-' + yyyy;

            return nextt
        }

        //Get time
        var time = new Date();
        var hh = String(time.getHours()).padStart(2, '0');
        var mi = String(time.getMinutes()).padStart(2, '0');
        var ss = String(time.getSeconds()).padStart(2, '0');


        time = hh + ':' + mi + ':' + ss;


        // Function when click yesterday button
        $(function (){
            $(yesterday).click(function (){
                $('#created_at').val(getPreviousDay())

                if (yes_tr_1.style.display === 'none' && yes_tr_2.style.display === 'none' && yes_tr_3.style.display === 'none') {
                    // 👇️ this SHOWS the form
                    yes_tr_1.style.display = 'table'
                    yes_tr_2.style.display = 'table'
                    yes_tr_3.style.display = 'table'

                    tod_tr_1.style.display = 'none';
                    tod_tr_2.style.display = 'none';
                    tod_tr_3.style.display = 'none';

                }
            })
        })

        // Function when click today button
        $(function (){
            $(today).click(function (){
                $('#created_at').val(getToday() +" "+ time)
            })
        })

        $(function (){
            $(tomorrow).click(function (){
                $('#created_at').val(getNextDay())
            })
        })

        $('#created_at').val(getToday() +" "+ time)

        $(function(){
            $(breakfastBtn).click(function(){
                mealForm.action = "{{route('dairy.breakfast.store')}}"
                food_list.style.display = 'block';;
                inpSearch.style.display = 'block';
                foodFormDiv.style.display = 'block';
                addF.innerHTML = 'Add Breakfast'
            });
        });
        $(function(){
            $(lunchBtn).click(function(){
                mealForm.action = "{{route('dairy.lunch.store')}}"
                food_list.style.display = 'block';
                inpSearch.style.display = 'block';
                foodFormDiv.style.display = 'block';
                addF.innerHTML = 'Add Lunch'
            });
        });

        $(function(){
            $(dinnerBtn).click(function(){
                mealForm.action = "{{route('dairy.dinner.store')}}"
                food_list.style.display = 'block';
                inpSearch.style.display = 'block';
                foodFormDiv.style.display = 'block';
                addF.innerHTML = 'Add Dinner'
            });
        });
    </script>
@stop
