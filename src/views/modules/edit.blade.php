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
                        <form role="form" method="post" action="{{route( strtolower($pageTitle) . '.update', $module->id )}}">
                            @method('PUT')
                            @csrf
                            <!---Name--->
                            <div class="form-group">
                                <label for="name" class="font-bold">Name<span class="text-danger">*</span></label>
                                <input type="hidden" name="id" value="{{ $module->id }}">
                                <input type="text" name="name" value="{{ old('name', $module->name) }}" placeholder="Enter name" maxlength="100" class="form-control" required>
                                <span class="form-text m-b-none text-danger"> @error('name') {{ $message }} @enderror </span>
                            </div>
                                <!---icon--->
                                <div class="form-group">
                                    <label for="icon" class="font-bold">Icon<span class="text-danger">*</span></label>
                                    <input type="text" name="icon" value="{{ old('icon', $module->icon) }}" placeholder="Enter icon" maxlength="50" class="form-control" required>
                                    <span class="form-text m-b-none text-danger"> @error('icon') {{ $message }} @enderror </span>
                                </div>
                                <!---Home Url--->
                                <div class="form-group">
                                    <label for="home_url" class="font-bold">Home Url<span class="text-danger">*</span></label>
                                    <input type="text" name="home_url" value="{{ old('home_url', $module->home_url) }}" placeholder="Enter home url" class="form-control" required>
                                    <span class="form-text m-b-none text-danger"> @error('home_url') {{ $message }} @enderror </span>
                                </div>

                                <!---Description--->
                                <div class="form-group">
                                    <label for="description" class="font-bold">Description</label>
                                    <textarea name="description" class="form-control">{{ old('description', $module->description) }}</textarea>
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
