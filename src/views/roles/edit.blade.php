@extends('matrixusermanagement::app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    @include('matrixusermanagement::partials.flash')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5><i class="fa fa-shopping-bag"></i> {{ $pageTitle }} Update Form</h5>
                        <div class="ibox-tools">
                            <a style="margin-top: -8px;" href="{{ route( strtolower($pageTitle) . '.index') }}" class="btn btn-primary"><i
                                    class="fa fa-list"></i> List</a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <!---FORM--->
                        <form role="form" method="post" action="{{route( strtolower($pageTitle) . '.update', $role->id )}}">
                            @method('PUT')
                            @csrf
                            <!---Name--->
                            <div class="form-group">
                                <label for="name" class="font-bold">Name<span class="text-danger">*</span></label>
                                <input type="hidden" name="id" value="{{ $role->id }}">
                                <input type="text" name="name" value="{{ old('name', $role->name) }}" placeholder="Enter name" maxlength="100" class="form-control" required>
                                <span class="form-text m-b-none text-danger"> @error('name') {{ $message }} @enderror </span>
                            </div>

                            <!---min_username_length--->
                            <div class="form-group">
                                <label for="min_username_length" class="font-bold">Minimum Username Length<span class="text-danger">*</span></label>
                                <input type="text" name="min_username_length" value="{{ old('min_username_length', $role->min_username_length) }}" placeholder="Enter minimum username length" maxlength="2" class="form-control" required>
                                <span class="form-text m-b-none text-danger"> @error('min_username_length') {{ $message }} @enderror </span>
                            </div>

                            <!---max_username_length--->
                            <div class="form-group">
                                <label for="max_username_length" class="font-bold">Maximum Username Length<span class="text-danger">*</span></label>
                                <input type="text" name="max_username_length" value="{{ old('max_username_length', $role->max_username_length) }}" placeholder="Enter maximum username length" maxlength="2" class="form-control" required>
                                <span class="form-text m-b-none text-danger"> @error('max_username_length') {{ $message }} @enderror </span>
                            </div>

                            <!---multi_login_allow--->
                            <div class="form-group">
                                <label for="multi_login_allow" class="font-bold">Multi Login Allow ?<span class="text-danger">*</span></label>
                                <select name="multi_login_allow" class="form-control">
                                    <option value="1" @if($role->password_expiry_action == '1') selected @endif>Yes</option>
                                    <option value="0" @if($role->password_expiry_action == '0') selected @endif>No</option>
                                </select>
                                <span class="form-text m-b-none text-danger"> @error('multi_login_allow') {{ $message }} @enderror </span>
                            </div>

                            <!---max_wrong_login_attempt--->
                            <div class="form-group">
                                <label for="max_wrong_login_attempt" class="font-bold">Maximum Wrong Login Attempt<span class="text-danger">*</span></label>
                                <input type="text" name="max_wrong_login_attempt" value="{{ old('max_wrong_login_attempt', $role->max_wrong_login_attempt) }}" placeholder="Enter max wrong login attempt" maxlength="2" class="form-control" required>
                                <span class="form-text m-b-none text-danger"> @error('max_wrong_login_attempt') {{ $message }} @enderror </span>
                            </div>

                            <!---wrong_login_attempt--->
                            <div class="form-group">
                                <label for="wrong_login_attempt" class="font-bold">Wrong Login Attempt<span class="text-danger">*</span></label>
                                <select name="wrong_login_attempt" class="form-control">
                                    <option value="No Restriction" @if($role->password_expiry_action == 'No Restriction') selected @endif>No Restriction</option>
                                    <option value="Blocked" @if($role->password_expiry_action == 'Blocked') selected @endif>Blocked</option>
                                    <option value="Block for a Period" @if($role->password_expiry_action == 'Block for a Period') selected @endif>Block for a Period</option>
                                </select>
                                <span class="form-text m-b-none text-danger"> @error('wrong_login_attempt') {{ $message }} @enderror </span>
                            </div>

                            <!---block_period--->
                            <div class="form-group">
                                <label for="block_period" class="font-bold">Block Period<span class="text-danger">*</span></label>
                                <input type="text" name="block_period" value="{{ old('block_period', $role->block_period) }}" placeholder="Enter block period" maxlength="2" class="form-control" required>
                                <span class="form-text m-b-none text-danger"> @error('block_period') {{ $message }} @enderror </span>
                            </div>

                            <!---session_time_out--->
                            <div class="form-group">
                                <label for="session_time_out" class="font-bold">Session Time Out<span class="text-danger">*</span></label>
                                <input type="text" name="session_time_out" value="{{ old('session_time_out', $role->session_time_out) }}" placeholder="Enter session_time_out" maxlength="2" class="form-control" required>
                                <span class="form-text m-b-none text-danger"> @error('session_time_out') {{ $message }} @enderror </span>
                            </div>

                            <!---password_regEx--->
                            <div class="form-group">
                                <label for="password_regEx" class="font-bold">Password RegEx<span class="text-danger">*</span></label>
                                <input type="text" name="password_regEx" value="{{ old('password_regEx', $role->password_regEx) }}" placeholder="Enter password regEx" class="form-control" required>
                                <span class="form-text m-b-none text-danger"> @error('password_regEx') {{ $message }} @enderror </span>
                            </div>

                            <!---password_regEx_error_msg--->
                            <div class="form-group">
                                <label for="password_regEx_error_msg" class="font-bold">Password RegEx Error Message<span class="text-danger">*</span></label>
                                <input type="text" name="password_regEx_error_msg" value="{{ old('password_regEx_error_msg', $role->password_regEx_error_msg) }}" placeholder="Enter password regEx error message" class="form-control" required>
                                <span class="form-text m-b-none text-danger"> @error('password_regEx_error_msg') {{ $message }} @enderror </span>
                            </div>

                            <!---password_expiry_notify--->
                            <div class="form-group">
                                <label for="password_expiry_notify" class="font-bold">Password Expiry Notify<span class="text-danger">*</span></label>
                                <input type="text" name="password_expiry_notify" value="{{ old('password_expiry_notify', $role->password_expiry_notify) }}" placeholder="Enter password expiry notify" class="form-control" required>
                                <span class="form-text m-b-none text-danger"> @error('password_expiry_notify') {{ $message }} @enderror </span>
                            </div>

                            <!---password_expiry_duration--->
                            <div class="form-group">
                                <label for="password_expiry_duration" class="font-bold">Password Expiry Duration<span class="text-danger">*</span></label>
                                <input type="text" name="password_expiry_duration" value="{{ old('password_expiry_duration', $role->password_expiry_duration) }}" placeholder="Enter password expire duration" class="form-control" required>
                                <span class="form-text m-b-none text-danger"> @error('password_expiry_duration') {{ $message }} @enderror </span>
                            </div>

                            <!---password_expiry_action--->
                            <div class="form-group">
                                <label for="password_expiry_action" class="font-bold">Password Expiry Action<span class="text-danger">*</span></label>
                                <select name="password_expiry_action" class="form-control">
                                    <option value="Notify" @if($role->password_expiry_action == 'Notify') selected @endif>Notify</option>
                                    <option value="Force" @if($role->password_expiry_action == 'Force') selected @endif>Force</option>
                                </select>
                                <span class="form-text m-b-none text-danger"> @error('password_expiry_action') {{ $message }} @enderror </span>
                            </div>

                            <!---Description--->
                            <div class="form-group">
                                <label for="description" class="font-bold">Description<span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control">{{ old('description', $role->description)}}</textarea>
                                <span class="form-text m-b-none text-danger"> @error('description') {{ $message }} @enderror </span>
                            </div>

                            <!---{{ $pageTitle }} CONTROL BUTTON--->
                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
                                    <a class="btn btn-danger" href="{{route( strtolower($pageTitle) . '.index')}}"><i class="fa fa-fw fa-lg fa-arrow-left"></i>List</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
