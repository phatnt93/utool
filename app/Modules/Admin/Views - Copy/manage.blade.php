@extends('Admin::layout')

@section('scripts')
<script src="{{ asset('assets/admin/components/datatable.js') }}"></script>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title ?? '' }}</h3>
        </div>
        <div class="card-body datatable p-0" data-url="{{ $datatableurl ?? '' }}">
            <div class="loader"></div>
        </div>
    </div>
@endsection