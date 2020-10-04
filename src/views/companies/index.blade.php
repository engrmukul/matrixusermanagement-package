@extends('matrixusermanagement::app')
@section('title') {{ $pageTitle }} @endsection
@section('content')

    @include('matrixusermanagement::partials.flash')
    <div class="row">
        <div class="col-md-12">
            <h5><i class="fa fa-list"></i>List</h5>
                <a style="margin-top: -8px;" href="{{ route( strtolower($pageTitle) . '.create') }}" class="btn btn-primary"><i
                        class="fa fa-plus"></i> New Create</a>
            <div class="table-responsive">
                @include('matrixusermanagement::partials.datatable')
            </div>
        </div>
    </div>
@endsection
