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
                        <form role="form" method="post" action="{{route( strtolower($pageTitle) . '.update', $company->id )}}">
                            @method('PUT')
                            @csrf
                            <!---Name--->
                            <div class="form-group">
                                <label for="name" class="font-bold">Name<span class="text-danger">*</span></label>
                                <input type="hidden" name="id" value="{{ $company->id }}">
                                <input type="text" name="name" value="{{ old('name', $company->name) }}" placeholder="Enter name" maxlength="100" class="form-control" required>
                                <span class="form-text m-b-none text-danger"> @error('name') {{ $message }} @enderror </span>
                            </div>
                            <!---Email--->
                            <div class="form-group">
                                <label for="name" class="font-bold">Email<span class="text-danger">*</span></label>
                                <input type="text" name="email" value="{{ old('email', $company->email) }}" placeholder="Enter email" maxlength="50" class="form-control" required>
                                <span class="form-text m-b-none text-danger"> @error('email') {{ $message }} @enderror </span>
                            </div>
                            <!---Phone--->
                            <div class="form-group">
                                <label for="mobile" class="font-bold">Phone<span class="text-danger">*</span></label>
                                <input type="text" name="phone" value="{{ old('phone', $company->phone) }}" maxlength="11" placeholder="Enter phone" class="form-control" required>
                                <span class="form-text m-b-none text-danger"> @error('phone') {{ $message }} @enderror </span>
                            </div>
                            <!---Phone--->
                            <div class="form-group">
                                <label for="website" class="font-bold">Website<span class="text-danger">*</span></label>
                                <input type="text" name="website" value="{{ old('website', $company->website) }}" maxlength="11" placeholder="Enter phone" class="form-control" required>
                                <span class="form-text m-b-none text-danger"> @error('website') {{ $message }} @enderror </span>
                            </div>
                            <!---Address--->
                            <div class="form-group">
                                <label for="address" class="font-bold">Address</label>
                                <textarea name="address" class="form-control">{{ old('address', $company->address) }}</textarea>
                                <span class="form-text m-b-none text-danger"> @error('address') {{ $message }} @enderror </span>
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
