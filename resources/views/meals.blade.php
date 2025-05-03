@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a type="button" class="btn btn-pink" href="{{route('add.food')}}">Add Food +</a>
            <a type="button" class="btn btn-pink" href="#">Add Meal +</a>
            <a type="button" class="btn btn-pink" href="{{route('dairy')}}">Food dairy +</a>
        </div>
    </div>
<br>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-my-food-tab" data-bs-toggle="tab" data-bs-target="#nav-my-food" type="button" role="tab" aria-controls="nav-my-food" aria-selected="true">My Food</button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">All Meals</button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-my-food" role="tabpanel" aria-labelledby="nav-my-food-tab">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Food Name</th>
                    <th scope="col">Calories</th>
                    <th scope="col">Handle</th>
                </tr>
                </thead>
                <tbody>
                @foreach($foods as $food=>$item)

                    <tr>
                        <th scope="row">{{$food + 1}}</th>
                        <td>{{$item->Food_Name}}</td>
                    <td>{{$item->calories}}</td>
                    <td>@mdo</td>
                </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Food Name</th>
                    <th scope="col">Calories</th>
                    <th scope="col">Handle</th>
                </tr>
                </thead>
                <tbody>
                @foreach($all_foods as $key => $food)

                    <tr>
                        <th scope="row">{{$key + 1}}</th>
                        <td>{{$food->Food_Name}}</td>
                        <td>{{$food->calories}}</td>
                        <td>@mdo</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


</div>
@endsection
