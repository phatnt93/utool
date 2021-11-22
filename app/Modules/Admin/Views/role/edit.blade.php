@extends('Admin::layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title ?? '' }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">{{ trans('name') }}</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="email">{{ trans('email') }}</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="password">{{ trans('password') }}</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="form-group">
                    <label for="password">{{ trans('cfpassword') }}</label>
                    <input type="password" class="form-control" id="cfpassword" name="cfpassword">
                </div>
                <div class="form-group">
                    <label for="roleid">{{ trans('role') }}</label>
                    <select name="roleid" id="roleid" class="form-control">
                        <option value=""></option>
                    </select>
                </div>
            </form>
        </div>
    </div>
@endsection