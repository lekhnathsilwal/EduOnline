@extends('app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Student Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('student.register') }}" enctype="multipart/form-data" aria-label="{{ __('Register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Eg: Sudip Gharti Magar" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="faculty" class="col-md-4 col-form-label text-md-right">{{ __('Faculty') }}</label>
                            <div class="col-md-6">
                                    <select name="faculty" id="faculty" class="form-control">
                                            <option value="science_and_technology">Science And Technology</option>
                                    </select>
                                @if ($errors->has('faculty'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('faculty') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="program" class="col-md-4 col-form-label text-md-right">{{ __('Program') }}</label>
                            <div class="col-md-6">
                                <select name="program" id="program" class="form-control">
                                        <option value="bachelor_in_architecture">Bachelor In Architecture</option>
                                        <option value="bachelor_in_biomedical_engineering">Bachelor In Biomedical Engineering</option>
                                        <option value="bachelor_in_civil_engineering">Bachelor In Civil Engineering</option>
                                        <option value="bachelor_in_computer_engineering">Bachelor In Computer Engineering</option>
                                        <option value="bachelor_in_electrical_engineering">Bachelor In Electrical Engineering</option>
                                        <option value="bachelor_in_electronics_and_communication_engineering">Bachelor In Electronics And Communication Engineering</option>
                                        <option value="bachelor_of_computer_application">Bachelor Of Computer Application</option>
                                </select>
                                @if ($errors->has('program'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('program') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Eg: sudip.magar.gm@gmail.com" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="college" class="col-md-4 col-form-label text-md-right">{{ __('Engaged College/Institute') }}</label>
                            <div class="col-md-6">
                                <input id="college" type="text" class="form-control{{ $errors->has('college') ? ' is-invalid' : '' }}" placeholder="Eg: Acme engineering college" name="college" value="{{ old('college') }}" required autofocus>
                                @if ($errors->has('college'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('college') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="student_card" class="col-md-4 col-form-label text-md-right">{{ __('Student Card') }}</label>
                            <div class="col-md-6">
                                <input id="student_card" type="file" name="student_card" value="{{ old('student_card') }}" required autofocus>
                                @if ($errors->has('student_card'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('student_card') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="profile_picture" class="col-md-4 col-form-label text-md-right">{{ __('Profile Picture') }}</label>
                            <div class="col-md-6">
                                <input id="profile_picture" type="file" name="profile_picture" value="{{ old('profile_picture') }}" autofocus>
                                @if ($errors->has('profile_picture'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('profile_picture') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
