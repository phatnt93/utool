@extends('Admin::layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title ?? '' }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ ($action == 'create' ? route('admin.user.store') : route('admin.user.update', ['id' => ria('id', $item)])) }}" method="post" enctype="multipart/form-data">
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
                            <label for="email">{{ trans('email') }}</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ ria('email', $item) }}" {{ $action == 'edit' ? 'readonly' : ''}}>
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">{{ trans('password') }}</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ ria('password', $item) }}">
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">{{ trans('password_confirmation') }}</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" value="{{ ria('password_confirmation', $item) }}">
                            @error('password_confirmation')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="role_id">{{ trans('role_id') }}</label>
                            <select name="role_id" id="role_id" class="form-control select2 @error('role_id') is-invalid @enderror">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" {{ ria('role_id', $item) == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role_id')
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
                    <a href="{{ route('admin.user.manage') }}" class="btn btn-default">{{ trans('back') }}</a>
                    <button type="submit" class="btn btn-primary">{{ trans('save') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection