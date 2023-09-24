@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('main_trans.list_Graduate') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main_trans.list_Graduate') }} <i class="fas fa-user-graduate"></i>
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50" style="text-align: center">
                                    <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>{{ trans('Students_trans.name') }}</th>
                                            <th>{{ trans('Students_trans.email') }}</th>
                                            <th>{{ trans('Students_trans.gender') }}</th>
                                            <th>{{ trans('Students_trans.Grade') }}</th>
                                            <th>{{ trans('Students_trans.classrooms') }}</th>
                                            <th>{{ trans('Students_trans.section') }}</th>
                                            <th>{{ trans('Students_trans.Processes') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $student)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $student->name }}</td>
                                                <td>{{ $student->email }}</td>
                                                <td>{{ $student->gender->name }}</td>
                                                <td>{{ $student->grade->name }}</td>
                                                <td>{{ $student->classroom->name }}</td>
                                                <td>{{ $student->section->name }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-sm return"
                                                        data-toggle="modal"
                                                        data-target="#return"
                                                        data-id="{{$student->id}}"
                                                        data-name="{{$student->name}}"
                                                        title="{{ trans('Grades_trans.Delete') }}">ارجاع
                                                        الطالب</button>
                                                    <button type="button" class="btn btn-danger btn-sm delete"
                                                        data-toggle="modal"
                                                        data-target="#delete"
                                                        data-id="{{$student->id}}"
                                                        data-name="{{$student->name}}"
                                                        title="{{ trans('Grades_trans.Delete') }}">حذف
                                                        الطالب</button>

                                                </td>
                                            </tr>
                                            @endforeach
                                        </table>
                                        @include('pages.students.graduated.return')
                                        @include('pages.students.graduated.delete')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
<script>
    $(document).ready(function() {
        $('.delete').on('click', function() {
            $('#delete-id').val($(this).data('id'))
            $('#delete-name').val($(this).data('name'))
        })
        $('.return').on('click', function() {
            $('#return-id').val($(this).data('id'))
            $('#return-name').val($(this).data('name'))
        })
    })
</script>
@endsection
