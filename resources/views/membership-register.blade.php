@extends('layouts.nav2')
@section('content')


    <section class="section-reg-form">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="heading-h2">Join Our {{$membership->name}} Membership </h2>
                </div>
                <div class="col-sm-9 mx-auto">
                    <div class="card">
                        <div class="card-body form-box">
                            <form action="{{route('membership.store')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="firstName" class="col-form-label-sm">First Name</label>
                                    <input type="text" class="form-control form-control-sm @error('first_name') is-invalid @enderror" id="firstName" name="first_name"
                                           placeholder="Enter First Name" value="{{$auth->name}}">
                                    @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label-sm @error('gender') is-invalid @enderror">Gender</label>
                                    <select name="gender" class="form-control form-control-sm">
                                        <option value="male" {{ $auth->calorieCalculator->sex == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ $auth->calorieCalculator->sex == 'female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                    @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="currentWeight" class="col-form-label-sm">Your current weight</label>
                                    <input type="number" class="form-control form-control-sm @error('current_weight') is-invalid @enderror" id="currentWeight"
                                           placeholder="Your current weight" name="current_weight" value="{{ old('current_weight', $auth->calorieCalculator->weight ?? '') }}">
                                    <div class="col-md-3">
                                        <input name="weight-unit" type="radio" value="lbs" {{ old('weight-unit') == 'lbs' ? 'checked' : '' }}> <span>lbs</span>
                                    </div>
                                    <div class="col-md-3">
                                        <input name="weight-unit" type="radio" value="kg" {{ old('weight-unit') == 'kg' ? 'checked' : '' }}>  <span>Kg</span>
                                    </div>
                                    @error('current_weight')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="desiredWeight" class="col-form-label-sm">Desired weight</label>
                                    <input type="number" class="form-control form-control-sm @error('desired_weight') is-invalid @enderror" id="desiredWeight"
                                           placeholder="Your desired weight" name="desired_weight" value="{{ old('desired_weight') }}">
                                    @error('desired_weight')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="height" class="col-form-label-sm">Height</label>
                                    <input type="text" class="form-control form-control-sm  @error('height') is-invalid @enderror" id="height"
                                           placeholder="Height" name="height" value="{{$auth->calorieCalculator->height}}">
                                    <div class="col-md-3">
                                        <input name="height-unit" type="radio" value="inches"> <span>Inches</span>
                                    </div>
                                    <div class="col-md-3">
                                        <input name="height-unit" type="radio" value="cm"> <span>cm</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="city" class="col-form-label-sm  @error('branch') is-invalid @enderror">Branches</label>
                                    <input type="text" class="form-control form-control-sm" id="city"
                                           placeholder="Branch" name="branch">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="col-form-label-sm">Email address</label>
                                    <input type="email" class="form-control form-control-sm  @error('email') is-invalid @enderror" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="{{$auth->email}}">
                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="col-form-label-sm  @error('phone') is-invalid @enderror">Phone</label>
                                    <input type="number" class="form-control form-control-sm" id="phone" placeholder="Phone no" name="phone">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label-sm">Please select your plan</label>
                                    <select name="plan" class="form-control form-control-sm  @error('plan') is-invalid @enderror">
                                        @foreach($memberships as $membership)
                                            <option value="{{$membership->id}}" {{ $membership->id == $id ? 'selected' : '' }}>
                                                {{$membership->name}}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1"  name="agree" value="agree">
                                    <label class="form-check-label check-lbl" for="exampleCheck1">I agree all terms &
                                        conditions</label>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block custom-submit-btn" name="btn" value="submit">
                                        <span>JOIN NOW</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if ($message = \Session::get('success'))
                        <div class="custom-alerts alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                            {!! $message !!}
                        </div>
                        <?php \Session::forget('success');?>
                    @endif

                    @if ($message = \Session::get('error'))
                        <div class="custom-alerts alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                            {!! $message !!}
                        </div>
                        <?php \Session::forget('error');?>
                    @endif
                    <h2 style="text-align: center"> Checkout Form</h2>
                    <div class="col-md-12">
                        <div class="col-75">
                            <div class="container">

                                <div style="text-align: center" class="row">
                                    <div class="col-md-12">
                                        <div class="col-75">
                                            <div class="container">
                                                <div style="text-align: center" class="row">
                                                    <div class="col-md-12">
                                                        <button id="paymobButton" class="btn">Paymob</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="paymobContainer"></div> <!-- Add this div element -->                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('paymobButton').addEventListener('click', function () {
                // Make a POST request to your controller action
                fetch('{{ route('credit') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Get the iframe URL from the response and set it as the iframe source
                            const iframeUrl = data.iframe_url;
                            const iframe = document.createElement('iframe');
                            iframe.src = iframeUrl;
                            iframe.width = '100%';
                            iframe.height = '500px';

                            const container = document.getElementById('paymobContainer');
                            container.innerHTML = ''; // Clear the container
                            container.appendChild(iframe);
                        } else {
                            // Handle error response
                            console.error('Error:', data.error_message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });
    </script>
@endsection
