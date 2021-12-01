@extends('Admin::layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title ?? '' }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.role.permission', ['id' => $role_id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <a href="{{ route('admin.role.manage') }}" class="btn btn-default">{{ trans('back') }}</a>
                    <button type="submit" class="btn btn-primary">{{ trans('save') }}</button>
                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="20%">{{ trans('key') }}</th>
                            <th>{{ trans('name') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($actions as $ka => $action)
                            @if (is_array($action))
                                @foreach ($action as $kai => $ai)
                                    @php
                                        if (is_numeric($kai)) {
                                            continue;
                                        }
                                    @endphp
                                    @foreach ($ai as $ki => $item)
                                        @if (is_numeric($ki))
                                        <tr>
                                            <td>{{ $item }}</td>
                                            <td></td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td></td>
                                            <td>
                                                @php
                                                    $k = $ka . '.' . $kai . '.' . $ki;
                                                @endphp
                                                <div class="icheck-primary">
                                                    <input class="check-item" type="checkbox" id="per-{{ $k }}" name="permission[]" value="{{ $k }}" {{ in_array($k, $permissionChecked) ? 'checked' : '' }}>
                                                    <label for="per-{{ $k }}" style="font-weight: 400;">{{ $item }}</label>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </form>
        </div>
    </div>
@endsection