@extends('Admin::layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title ?? '' }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ ($action == 'create' ? route('admin.role.store') : route('admin.role.update', ['id' => ria('id', $item)])) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="form-group">
                            <label for="name">{{ trans('name') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ ria('name', $item) }}">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('description') }}</label>
                            <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ ria('description', $item) }}</textarea>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        @if ($action == 'edit')
                        <div class="form-group">
                            <label for="status">{{ trans('status') }}</label>
                            <select name="status" id="status" class="form-control select2 @error('status') is-invalid @enderror">
                                {!! common()->renderDisEna(ria('status', $item)) !!}
                            </select>
                            @error('status')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        @endif
                    </div>
                </div>
                <div class="form-group text-center">
                    <a href="{{ route('admin.role.manage') }}" class="btn btn-default">{{ trans('back') }}</a>
                    <button type="submit" class="btn btn-primary">{{ trans('save') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection