
@extends('Admin::layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title ?? '' }}</h3>
        </div>
        <div class="card-body p-0">
            <div class="col-md-12">
                Welcome!
            </div>
        </div>
    </div>
@endsection