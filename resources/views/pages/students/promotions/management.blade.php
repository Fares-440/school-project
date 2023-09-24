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

                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Delete_all">
                                تراجع الكل
                            </button>
                            <br><br>


                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th class="alert-info">#</th>
                                            <th class="alert-info">{{ trans('Students_trans.name') }}</th>
                                            <th class="alert-danger">المرحلة الدراسية السابقة</th>
                                            <th class="alert-danger">السنة الدراسية</th>
                                            <th class="alert-danger">الصف الدراسي السابق</th>
                                            <th class="alert-danger">القسم الدراسي السابق</th>
                                            <th class="alert-success">المرحلة الدراسية الحالي</th>
                                            <th class="alert-success">السنة الدراسية الحالية</th>
                                            <th class="alert-success">الصف الدراسي الحالي</th>
                                            <th class="alert-success">القسم الدراسي الحالي</th>
                                            <th>{{ trans('Students_trans.Processes') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($promotions as $promotion)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="{{ route('students.show', $promotion->id) }}"
                                                        class="text-success">
                                                        {{ $promotion->student->name }}
                                                    </a>
                                                </td>
                                                <td>{{ $promotion->from_Grade->name }}</td>
                                                <td>{{ $promotion->academic_year }}</td>
                                                <td>{{ $promotion->from_classroom->name }}</td>
                                                <td>{{ $promotion->from_Section->name }}</td>
                                                <td>{{ $promotion->to_Grade->name }}</td>
                                                <td>{{ $promotion->academic_year_new }}</td>
                                                <td>{{ $promotion->to_classroom->name }}</td>
                                                <td>{{ $promotion->to_Section->name }}</td>
                                                <td class="d-flex">
                                                    <button type="button" class="btn btn-outline-danger delete"
                                                        data-toggle="modal" data-target="#delete"
                                                        data-id="{{ $promotion->id }}"
                                                        data-name="{{ $promotion->student->name }}">ارجاع
                                                        الطالب</button>
                                                    <button type="button" class="btn btn-outline-success"
                                                        data-toggle="modal" data-target="#">تخرج الطالب</button>
                                                </td>
                                            </tr>
                                            @include('pages.students.promotions.delete_all')
                                        @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
<!-- Deleted inFormation Student -->
<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">تراجع طالب
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('promotions.destroy', 'test') }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="delete-id" name="id">
                    <h5 style="font-family: 'Cairo', sans-serif;">هل انت متاكد من عملية تراجع الطالب ؟
                        <span id="delete-name"></span>
                    </h5>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('Students_trans.Close') }}</button>
                        <button class="btn btn-danger">{{ trans('Students_trans.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('.delete').on('click', function() {
            $('#delete-id').val($(this).data('id'))
            $('#delete-name').text($(this).data('name'))
        })
    })
</script>
@toastr_js
@toastr_render
@endsection
