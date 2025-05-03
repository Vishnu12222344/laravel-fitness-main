@extends('layouts.nav2')
@section('content')


    <section class="section-membership my-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="heading-h2">OUR MEMBERSHIPS</h2>
                </div>
                @foreach($memberships as $membership)
                <div class="col-xl-4 col-lg-4 col-md-4 box-mem">
                    <div class="card">
                        <div class="card-header-style">
                            <h3 class="card-title mem-title">{{$membership->name}} </h3>
                            <p class="plan-price">{{$membership->price}} LE<span> / year</span></p>
                            <p class="plan-price-mem">{{$membership->desciption}}</p>
                        </div>
                        <div class="sign-up-pre">
                            <a href="{{route('membership.register', $membership->id)}}"><span>Sign up now</span></a>
                        </div>
                        <ul class="memberli">
                            @php
                                $features = json_decode($membership->features);
                            @endphp
                            <li class="memberli"><i class="icon ion-ios-arrow-round-forward icon-small"></i>
                                <span>{!!  $features->unlimited_access ? '<i class="fa-solid fa-circle-check" style="color:#72ef83"></i>' : '<i class="fa-solid fa-circle-xmark" style="color:#fec0c1"></i>' !!}
                                    Unlimited access to the gym </span>
                            </li>
                            <li class="memberli"><i class="icon ion-ios-arrow-round-forward icon-small"></i>
                                <span>
                                    {!! $features->free_drinking_package ? '<i class="fa-solid fa-circle-check" style="color:#72ef83"></i>' : '<i class="fa-solid fa-circle-xmark" style="color:#fec0c1"></i>' !!}
                                    Free drinking package
                                </span>
                            </li>
                            <li class="memberli"><i class="icon ion-ios-arrow-round-forward icon-small"></i><span>{{ $features->classes_per_week }} classes per week</span></li>
                            <li class="memberli"><i class="icon ion-ios-arrow-round-forward icon-small"></i><span>{{ $features->free_personal_training }} Free personal training</span></li>
                        </ul>
                    </div>
                </div>
                @endforeach

                {{--<div class="col-xl-4 col-lg-4 col-md-4 box-mem">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mem-title">Gold Membership </h3>
                            <p class="plan-price">200$<span> / year</span></p>
                            <p class="plan-price-mem">That's only for fitness lovers</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><i class="icon ion-ios-arrow-round-forward icon-small"></i><span>Unlimited access to the gym</span>
                            </li>
                            <li class="list-group-item"><i class="icon ion-ios-arrow-round-forward icon-small"></i><span>5 classes per week</span>
                            </li>
                            <li class="list-group-item"><i class="icon ion-ios-arrow-round-forward icon-small"></i><span>One Year memberships</span>
                            </li>
                            <li class="list-group-item"><i class="icon ion-ios-arrow-round-forward icon-small"></i><span>FREE drinking package</span>
                            </li>
                            <li class="list-group-item"><i class="icon ion-ios-arrow-round-forward icon-small"></i><span>2 Free personal training</span>
                            </li>
                        </ul>
                        <div class="sign-up-nor">
                            <a href="registration-form.html"><span>Sign up now</span></a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 box-mem">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mem-title">Silver Membership </h3>
                            <p class="plan-price">100$<span> / year</span></p>
                            <p class="plan-price-mem">That's only for the newbie</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><i class="icon ion-ios-arrow-round-forward icon-small"></i><span>Unlimited access to the gym</span>
                            </li>
                            <li class="list-group-item"><i class="icon ion-ios-arrow-round-forward icon-small"></i><span>3 classes per week</span>
                            </li>
                            <li class="list-group-item"><i class="icon ion-ios-arrow-round-forward icon-small"></i><span>One Year memberships</span>
                            </li>
                            <li class="list-group-item"><i class="icon ion-ios-arrow-round-forward icon-small"></i><span>FREE drinking package</span>
                            </li>
                            <li class="list-group-item"><i class="icon ion-ios-arrow-round-forward icon-small"></i><span>1 Free personal training</span>
                            </li>
                        </ul>
                        <div class="sign-up-nor">
                            <a href="registration-form.html"><span>Sign up now</span></a>
                        </div>
                    </div>
                </div>--}}
            </div>
        </div>
    </section>

@endsection
