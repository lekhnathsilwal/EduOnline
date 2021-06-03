@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Profile') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ url('update-profile') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input hidden type="text" name="id" value="{{ $teacher->id }}">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $teacher->name }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('User Name') }}</label>
                                <div class="col-md-6">
                                    <input id="user_name" type="text" class="form-control{{ $errors->has('user_name') ? ' is-invalid' : '' }}" name="user_name" value="{{ $teacher->user_name }}" required autofocus>
                                    @if ($errors->has('user_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('user_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ $teacher->address }}" required autofocus>
                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="contact" class="col-md-4 col-form-label text-md-right">{{ __('Contact') }}</label>
                                <div class="col-md-6">
                                    <input id="contact" type="tel" class="form-control{{ $errors->has('contact') ? ' is-invalid' : '' }}" name="contact" value="{{ $teacher->contact }}" required autofocus>
                                    @if ($errors->has('contact'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('contact') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $teacher->email }}" required>
                                <input id="verification" hidden type="text" name="verification" value="{{$teacher->verification}}">                                
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="engaged_college" class="col-md-4 col-form-label text-md-right">{{ __('Engaged College') }}</label>
                                <div class="col-md-6">
                                    <input id="engaged_college" type="text" class="form-control{{ $errors->has('engaged_college') ? ' is-invalid' : '' }}" name="engaged_college" value="{{ $teacher->engaged_college }}" required autofocus>
                                    @if ($errors->has('engaged_college'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('engaged_college') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="teaching_faculty" class="col-md-4 col-form-label text-md-right">{{ __('Teaching Faculty') }}</label>
                                <div class="col-md-6">
                                        <select name="teaching_faculty" id="teaching_faculty" class="form-control">
                                                <option value="science_and_technology"
                                                <?php 
                                                    if($teacher->teaching_faculty == "science_and_technology"){
                                                        echo "selected";
                                                    } 
                                                ?>
                                                >Science And Technology</option>
                                        </select>
                                    @if ($errors->has('teaching_faculty'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('teaching_faculty') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="teaching_program" class="col-md-4 col-form-label text-md-right">{{ __('Teaching Program') }}</label>
                                <div class="col-md-6">
                                    <select name="teaching_program" id="teaching_program" class="form-control">
                                            <option value="bachelor_in_architecture" 
                                            <?php 
                                                if($teacher->teaching_program == "bachelor_in_architecture"){
                                                    echo "selected";
                                                } 
                                            ?>
                                            >Bachelor In Architecture</option>
                                            <option value="bachelor_in_biomedical_engineering"
                                            <?php 
                                                if($teacher->teaching_program == "bachelor_in_biomedical_engineering"){
                                                    echo "selected";
                                                } 
                                            ?>
                                            >Bachelor In Biomedical Engineering</option>
                                            <option value="bachelor_in_civil_engineering"
                                            <?php 
                                                if($teacher->teaching_program == "bachelor_in_civil_engineering"){
                                                    echo "selected";
                                                } 
                                            ?>
                                            >Bachelor In Civil Engineering</option>
                                            <option value="bachelor_in_computer_engineering"
                                            <?php 
                                                if($teacher->teaching_program == "bachelor_in_computer_engineering"){
                                                    echo "selected";
                                                } 
                                            ?>
                                            >Bachelor In Computer Engineering</option>
                                            <option value="bachelor_in_electrical_engineering"
                                            <?php 
                                                if($teacher->teaching_program == "bachelor_in_electrical_engineering"){
                                                    echo "selected";
                                                } 
                                            ?>
                                            >Bachelor In Electrical Engineering</option>
                                            <option value="bachelor_in_electronics_and_communication_engineering"
                                            <?php 
                                                if($teacher->teaching_program == "bachelor_in_electronics_and_communication_engineering"){
                                                    echo "selected";
                                                } 
                                            ?>
                                            >Bachelor In Electronics And Communication Engineering</option>
                                            <option value="bachelor_of_computer_application"
                                            <?php 
                                                if($teacher->teaching_program == "bachelor_of_computer_application"){
                                                    echo "selected";
                                                } 
                                            ?>
                                            >Bachelor Of Computer Application</option>
                                    </select>
                                    @if ($errors->has('teaching_program'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('teaching_program') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="citizenship" class="col-md-4 col-form-label text-md-right">{{ __('Citizenship') }}</label>
                                <div class="col-md-6">
                                    <input id="citizenship" type="file" name="citizenship" value="{{ old('citizenship') }}" autofocus>
                                    @if ($errors->has('citizenship'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('citizenship') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="teacher_card" class="col-md-4 col-form-label text-md-right">{{ __('Teacher Identity Card') }}</label>
                                <div class="col-md-6">
                                    <input id="teacher_card" type="file" name="teacher_card" value="{{ old('teacher_card') }}" autofocus>
                                    @if ($errors->has('teacher_card'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('teacher_card') }}</strong>
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
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
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