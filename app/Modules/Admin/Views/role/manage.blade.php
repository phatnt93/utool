@extends('Admin::layout')

@section('style-libs')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('script-libs')
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title ?? '' }}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <div class='form-group'>
                        <select name="order" id="order" class="form-control select2">
                            <option value="">{{ trans('order') }}</option>
                            <option value="name asc">{{ trans('name') . ' ' . trans('asc') }}</option>
                            <option value="name desc">{{ trans('name') . ' ' . trans('desc') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class='form-group'>
                        <input type="text" class='form-control' id="name" name="name" placeholder="{{ trans('name') }}">
                    </div>
                </div>
            </div>
            {!! init_datatable([
                '<div class="icheck-primary">
                    <input class="check-all" type="checkbox" id="ids-all" name="ids[]" value="">
                    <label for="ids-all"></label>
                </div>',
                trans('name'),
                trans('description'),
                trans('status'),
                '<a class="btn btn-success btn-sm" href="' . route('admin.role.create') . '">' . trans('create') . '</a>
                    <button type="button" class="btn btn-danger btn-sm btn-bulk-delete" data-href="' . route('admin.role.delete') . '">' . trans('bulk_delete') . '</button>'
            ], 'role') !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            // Datatable
            init_datatable('dtable-role', window.location.href + '/datatable', {
                selectorsSearch: ['name', 'order']
            });
            // END - Datatable
        });
    </script>
@endsection