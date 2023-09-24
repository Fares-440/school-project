@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('main_trans.list_students') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main_trans.list_students') }}
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
                            <a href="{{ route('students.create') }}" class="btn btn-success btn-sm" role="button"
                                aria-pressed="true">{{ trans('main_trans.add_student') }}</a><br><br>
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50" style="text-align: center">
                                    <thead>
                                        <tr>
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
                                                    <div class="dropdown show">
                                                        <a class="btn btn-success btn-sm dropdown-toggle" href="#"
                                                            role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            العمليات
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item"
                                                                href="{{ route('students.show', $student->id) }}"><i
                                                                    style="color: #ffc107" class="fa fa-eye "></i>&nbsp;
                                                                عرض بيانات
                                                                {{ $student->gender->id == '1' ? 'الطالب' : 'الطالبه' }}
                                                            </a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('students.edit', $student->id) }}"><i
                                                                    style="color:green" class="fa fa-edit"></i>&nbsp;
                                                                تعديل بيانات
                                                                {{ $student->gender->id == '1' ? 'الطالب' : 'الطالبه' }}</a>
                                                            <a href="javascript:void(0);" class="dropdown-item exit"
                                                                data-toggle="modal" data-target="#exit"
                                                                data-id="{{ $student->id }}"
                                                                data-name="{{ $student->name }}">
                                                                <i style="color: #ff2207"
                                                                    class="fa fa-sign-out"></i>&nbsp;تخرج
                                                                {{ $student->gender->id == '1' ? 'الطالب' : 'الطالبه' }}&nbsp;</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('fees_invoices.show', $student->id) }}"><i
                                                                    style="color: #0000cc"
                                                                    class="fa fa-edit"></i>&nbsp;اضافة فاتورة
                                                                رسوم&nbsp;</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('receipt_students.show', $student->id) }}"><i
                                                                    style="color: #9dc8e2"
                                                                    class="fa fa-money"></i>&nbsp; &nbsp;سند
                                                                قبض</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('processing_fee.show', $student->id) }}"><i
                                                                    style="color: #9dc8e2"
                                                                    class="fa fa-money"></i>&nbsp; &nbsp;
                                                                استبعاد رسوم</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('payment_students.show', $student->id) }}"><i
                                                                    style="color:goldenrod"
                                                                    class="fa fa-money"></i>&nbsp; &nbsp;سند صرف</a>
                                                            <a href="javascript:void(0);" class="dropdown-item delete"
                                                                data-toggle="modal" data-target="#delete"
                                                                data-id="{{ $student->id }}"
                                                                data-name="{{ $student->name }}"
                                                                title="{{ trans('Grades_trans.Delete') }}"><i
                                                                    style="color: red" class="fa fa-trash"></i>&nbsp;
                                                                حذف بيانات
                                                                {{ $student->gender->id == '1' ? 'الطالب' : 'الطالبه' }}</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @include('pages.students.delete')
                                        @endforeach
                                </table>
                            </div>
                            <div class="d-flex flex-row-reverse">
                                {{ $students->links('pagination::bootstrap-4') }}
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
        $('.exit').on('click', function() {
            $('#exit-id').val($(this).data('id'))
            $('#exit-name').val($(this).data('name'))
        })
    })
</script>
@endsection
