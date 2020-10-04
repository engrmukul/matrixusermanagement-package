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
                        <form role="form" method="post" action="{{route( strtolower($pageTitle) . '.update', $menu->id )}}">
                            @method('PUT')
                            @csrf
                            <!---Name--->
                            <div class="form-group">
                                <label for="name" class="font-bold">Name<span class="text-danger">*</span></label>
                                <input type="hidden" name="id" value="{{ $menu->id }}">
                                <input type="text" name="name" value="{{ old('name', $menu->name) }}" placeholder="Enter name" maxlength="100" class="form-control" required>
                                <span class="form-text m-b-none text-danger"> @error('name') {{ $message }} @enderror </span>
                            </div>
                                <!---Menu type--->
                                <div class="form-group">
                                    <label for="menu_type" class="font-bold">Menu Type<span class="text-danger">*</span></label>
                                    <select name="menu_type" class="form-control">
                                        <option value="Main" @if($menu->meny_type == 'Main') selected @endif>Main</option>
                                        <option value="Sub" @if($menu->meny_type == 'Sub') selected @endif>Sub</option>
                                    </select>
                                    <span class="form-text m-b-none text-danger"> @error('menu_type') {{ $message }} @enderror </span>
                                </div>

                                <!---Parent Menu--->
                                <div class="form-group">
                                    <label for="parent_id" class="font-bold">Parent Menu</label>
                                    <select id=parent class="form-control custom-select mt-15" name="parent_id">
                                        <option value="0">Select Parent Menu</option>
                                        @foreach($menus as $key => $mn)
                                            @if (old('parent_id') == $key)
                                                <option value="{{ $key }}" selected> {{ $mn }} </option>
                                            @else
                                                <option value="{{ $key }}"> {{ $mn }} </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span class="form-text m-b-none text-danger"> @error('parent_id') {{ $message }} @enderror </span>
                                </div>

                                <!---Module id--->
                                <div class="form-group">
                                    <label for="sys_module_id" class="font-bold">Module<span class="text-danger">*</span></label>
                                    <select id=parent class="form-control custom-select mt-15" name="sys_module_id">
                                        <option value="">Select Module</option>
                                        @foreach($modules as $key => $module)
                                            @if (old('sys_module_id', $menu->sys_module_id) == $module->id)
                                                <option value="{{ $module->id }}" selected> {{ $module->name }} </option>
                                            @else
                                                <option value="{{ $module->id }}"> {{ $module->name }} </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span class="form-text m-b-none text-danger"> @error('sys_module_id') {{ $message }} @enderror </span>
                                </div>

                                <!---icon--->
                                <div class="form-group">
                                    <label for="icon" class="font-bold">Icon<span class="text-danger">*</span></label>
                                    <input type="text" name="icon" value="{{ old('icon', $menu->icon) }}" placeholder="Enter icon" maxlength="50" class="form-control" required>
                                    <span class="form-text m-b-none text-danger"> @error('icon') {{ $message }} @enderror </span>
                                </div>

                                <!---Menu Url--->
                                <div class="form-group">
                                    <label for="menu_url" class="font-bold">Menu Url<span class="text-danger">*</span></label>
                                    <input type="text" name="menu_url" value="{{ old('menu_url', $menu->menu_url) }}" placeholder="Enter menu url" class="form-control" required>
                                    <span class="form-text m-b-none text-danger"> @error('menu_url') {{ $message }} @enderror </span>
                                </div>

                                <!---Sort Number--->
                                <div class="form-group">
                                    <label for="sort_number" class="font-bold">Sort Number<span class="text-danger">*</span></label>
                                    <input type="number" name="sort_number" min="1" value="{{ old('sort_number', $menu->sort_number)}}" placeholder="Enter sort number" class="form-control" required>
                                    <span class="form-text m-b-none text-danger"> @error('sort_number') {{ $message }} @enderror </span>
                                </div>

                                <!---Description--->
                                <div class="form-group">
                                    <label for="description" class="font-bold">Description</label>
                                    <textarea name="description" class="form-control">{{ old('description', $menu->description)}}</textarea>
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
