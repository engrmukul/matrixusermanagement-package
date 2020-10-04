@extends('matrixusermanagement::app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    @include('matrixusermanagement::partials.flash')
    <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5><i class="fa fa-plus"></i>New Create</h5>
                        <div class="ibox-tools">
                            <a style="margin-top: -8px;" href="{{ route( strtolower($pageTitle) . '.index') }}" class="btn btn-primary"><i
                                    class="fa fa-list"></i> List</a>
                        </div>
                    </div>

                    <div class="ibox-content">
                        <!---FORM--->
                        <form role="forBm" method="post" action="{{route( strtolower($pageTitle) . '.store')}}">
                            @csrf
                            <!---Name--->
                            <div class="form-group">
                                <label for="name" class="font-bold">Name<span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter name" maxlength="200" class="form-control" required>
                                <span class="form-text m-b-none text-danger"> @error('name') {{ $message }} @enderror </span>
                            </div>
                            <!---Short Name--->
                            <div class="form-group">
                                <label for="short_name" class="font-bold">Short Name<span class="text-danger">*</span></label>
                                <input type="text" name="short_name" value="{{ old('short_name') }}" placeholder="Enter short name" maxlength="50" class="form-control" required>
                                <span class="form-text m-b-none text-danger"> @error('short_name') {{ $message }} @enderror </span>
                            </div>
                            <!---CONTROL BUTTON--->
                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Create</button>
                                    <a class="btn btn-danger" href="{{route( strtolower($pageTitle) . '.index')}}"><i class="fa fa-fw fa-lg fa-arrow-left"></i>List</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
