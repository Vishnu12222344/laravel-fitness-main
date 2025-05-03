@extends('layouts.app')
@section('style-css')
    <link href="{{ asset('css/exercise.css') }}" rel="stylesheet">
    <link href="{{ asset('css/templatemo-liberty-market.css') }}" rel="stylesheet">
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/exercises.js') }}"></script>
@endsection
@section('content')

    <div class="categories-collections">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="categories">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-heading">
                                    <div class="line-dec"></div>
                                    <h2>Browse Through Our <em>Categories</em> Here.</h2>
                                </div>
                            </div>
                            @foreach($e_categories as $cate)
                            <div class="col-lg-2 col-sm-6">
                                <div class="item">
                                    <div class="icon">
                                        <img src="{{asset('assets/imgs/home-images/tabs-first-icon.png')}}" alt="">
                                    </div>
                                    <h4>{{$cate->name}}</h4>
                                    <div class="icon-button">
                                        <a href="{{route('exercise.types', $cate->id)}}"><i class="fa fa-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            {{--<div class="col-lg-2 col-sm-6">
                                <div class="item">
                                    <div class="icon">
                                        <img src="assets/images/icon-02.png" alt="">
                                    </div>
                                    <h4>Digital Art</h4>
                                    <div class="icon-button">
                                        <a href="#"><i class="fa fa-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6">
                                <div class="item">
                                    <div class="icon">
                                        <img src="assets/images/icon-03.png" alt="">
                                    </div>
                                    <h4>Music Art</h4>
                                    <div class="icon-button">
                                        <a href="#"><i class="fa fa-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6">
                                <div class="item">
                                    <div class="icon">
                                        <img src="assets/images/icon-04.png" alt="">
                                    </div>
                                    <h4>Virtual World</h4>
                                    <div class="icon-button">
                                        <a href="#"><i class="fa fa-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6">
                                <div class="item">
                                    <div class="icon">
                                        <img src="assets/images/icon-05.png" alt="">
                                    </div>
                                    <h4>Valuable</h4>
                                    <div class="icon-button">
                                        <a href="#"><i class="fa fa-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6">
                                <div class="item">
                                    <div class="icon">
                                        <img src="assets/images/icon-06.png" alt="">
                                    </div>
                                    <h4>Triple NFT</h4>
                                    <div class="icon-button">
                                        <a href="#"><i class="fa fa-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>--}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



    <div class="currently-market">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <div class="line-dec"></div>
                        <h2><em>Items</em> Currently In The Market.</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="filters">
                        <ul>
                            <li data-filter="*"  class="active">All Items</li>
                            @foreach($e_categories as $category)
                            <li data-filter=".{{\Illuminate\Support\Str::slug($category->name)}}">{{$category->name}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row grid">

                        @foreach($e_types as $type)
                        <div class="col-lg-6 currently-market-item all {{\Illuminate\Support\Str::slug($type->category->name)}}">
                            <div class="item">
                                <div class="left-image">
                                    <img src="{{asset($type->image)}}" alt="" style="border-radius: 20px; min-width: 195px;">
                                </div>
                                <div class="right-content">
                                    <h4>{{$type->name}}</h4>
                                    <span class="author">
                    <img src="{{asset('assets/imgs/home-images/tabs-first-icon.png')}}" alt="" style="max-width: 50px; border-radius: 50%;">
                    <h6>Category name<br><a href="#">{{$type->category->name}}</a></h6>
                </span>

                                    <div class="col-lg-12">
                                        <div class="line-dec"></div>
                                        <div class="row">
                                            <div class="col-6">
                                                <span>Burn: <br> <strong>{{($type->getSum('MET', $type->id) * ($type->getSum('counter', $type->id)/60) * $weight->weight) / 200}} Cal</strong></span>
                                            </div>
                                            <div class="col-6">
                                    <span>Time: <br> <strong>
                                            {{$type->getSum('counter', $type->id)}} Sec </strong></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                    <div class="text-button">
                                        <a href="{{route('exercises', $type->id)}}">Workout Now</a>
                                    </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
