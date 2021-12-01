@extends('Admin::layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title ?? '' }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ ($action == 'create' ? route('admin.menu.store') : route('admin.menu.update', ['id' => ria('id', $item)])) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md">
                        <div class="form-group">
                            <label for="name">{{ trans('name') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ ria('name', $item) }}">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="route_uri">{{ trans('route_uri') }}</label>
                            <input type="text" class="form-control @error('route_uri') is-invalid @enderror" id="route_uri" name="route_uri" value="{{ ria('route_uri', $item) }}">
                            @error('route_uri')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <label for="parent">{{ trans('parent') }}</label>
                            <select name="parent" id="parent" class="form-control select2 @error('parent') is-invalid @enderror">
                                <option value="0">{{ trans('select') }}</option>
                                @foreach ($parents as $parent)
                                    <option {{ $parent->id == ria('parent', $item) ? 'selected' : '' }} value="{{ $parent->id }}">{{ $parent->name }}</option>
                                @endforeach
                            </select>
                            @error('parent')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="sort">{{ trans('sort') }}</label>
                            <input type="number" class="form-control @error('sort') is-invalid @enderror" id="sort" name="sort" value="{{ ria('sort', $item, 0) }}">
                            @error('sort')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="icon">{{ trans('icon') }}</label>
                            <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" value="{{ ria('icon', $item, '') }}" placeholder="nav-icon fas fa-th">
                            @error('icon')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group text-center">
                    <a href="{{ route('admin.menu.manage') }}" class="btn btn-default">{{ trans('back') }}</a>
                    <button type="submit" class="btn btn-primary">{{ trans('save') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection