@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('Students_trans.Student_details') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Students_trans.Student_details') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="tab nav-border">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#home-02"
                                    role="tab" aria-controls="home-02"
                                    aria-selected="true">{{ trans('Students_trans.Student_details') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#profile-02"
                                    role="tab" aria-controls="profile-02"
                                    aria-selected="false">{{ trans('Students_trans.Attachments') }}</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="home-02" role="tabpanel"
                                aria-labelledby="home-02-tab">
                                <table class="table table-striped table-hover" style="text-align:center">
                                    <tbody>
                                        <tr>
                                            <th scope="row">{{ trans('Students_trans.name') }}</th>
                                            <td>{{ $student->name }}</td>
                                            <th scope="row">{{ trans('Students_trans.email') }}</th>
                                            <td>{{ $student->email }}</td>
                                            <th scope="row">{{ trans('Students_trans.gender') }}</th>
                                            <td>{{ $student->gender->name }}</td>
                                            <th scope="row">{{ trans('Students_trans.Nationality') }}</th>
                                            <td>{{ $student->nationalitie->name }}</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">{{ trans('Students_trans.Grade') }}</th>
                                            <td>{{ $student->grade->name }}</td>
                                            <th scope="row">{{ trans('Students_trans.classrooms') }}</th>
                                            <td>{{ $student->classroom->name }}</td>
                                            <th scope="row">{{ trans('Students_trans.section') }}</th>
                                            <td>{{ $student->section->name }}</td>
                                            <th scope="row">{{ trans('Students_trans.Date_of_Birth') }}</th>
                                            <td>{{ $student->date_birth }}</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">{{ trans('Students_trans.parent') }}</th>
                                            <td>{{ $student->parent->father_name }}</td>
                                            <th scope="row">{{ trans('Students_trans.academic_year') }}</th>
                                            <td>{{ $student->academic_year }}</td>
                                            <th scope="row"></th>
                                            <td></td>
                                            <th scope="row"></th>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="profile-02" role="tabpanel"
                                aria-labelledby="profile-02-tab">
                                <div class="card card-statistics">
                                    <div class="card-body">
                                        <form method="post" action="{{ route('upload_attachment') }}"
                                            enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label
                                                        for="academic_year">{{ trans('Students_trans.Attachments') }}
                                                        : <span class="text-danger">*</span></label>
                                                    <input type="file" accept="image/*" name="images[]" multiple
                                                        required>
                                                    <input type="hidden" name="student_name"
                                                        value="{{ $student->name }}">
                                                    <input type="hidden" name="student_id"
                                                        value="{{ $student->id }}">
                                                </div>
                                            </div>
                                            <br><br>
                                            <button type="submit" class="button button-border x-small">
                                                {{ trans('Students_trans.submit') }}
                                            </button>
                                        </form>
                                    </div>
                                    <br>
                                    <table class="table center-aligned-table mb-0 table table-hover"
                                        style="text-align:center">
                                        <thead>
                                            <tr class="table-secondary">
                                                <th scope="col">#</th>
                                                <th scope="col">{{ trans('Students_trans.filename') }}</th>
                                                <th scope="col">{{ trans('Students_trans.created_at') }}</th>
                                                <th scope="col">image</th>
                                                <th scope="col">{{ trans('Students_trans.Processes') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($student->images as $attachment)
                                                <tr style='text-align:center;vertical-align:middle'>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $attachment->filename }}</td>
                                                    <td>{{ $attachment->created_at->diffForHumans() }}</td>
                                                    <td><img class="img-thumbnail"
                                                            style="width: 200px;height:200px;object-fit:cover"
                                                            src="{{ url('get_attachment') }}/{{ $student->id }}/{{ $attachment->filename }}"
                                                            alt="" srcset=""></td>
                                                    <td colspan="2">
                                                        <a class="btn btn-outline-info btn-sm"
                                                            href="{{ url('download_attachment') }}/{{ $student->id }}/{{ $attachment->filename }}"
                                                            role="button"><i class="fa fa-download"></i>&nbsp;
                                                            {{ trans('Students_trans.Download') }}</a>

                                                        <button type="button"
                                                            class="btn btn-outline-danger btn-sm delete_img"
                                                            data-toggle="modal" data-target="#delete_img"
                                                            data-id="{{ $attachment->id }}"
                                                            data-student-id="{{ $attachment->imageable->id }}"
                                                            data-student-name="{{ $attachment->imageable->name }}"
                                                            data-file-name="{{ $attachment->filename }}"
                                                            title="{{ trans('Grades_trans.Delete') }}"><i class="fa fa-trash"></i>&nbsp;{{ trans('Students_trans.delete') }}
                                                        </button>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @include('pages.Students.delete_img')
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
                $(".delete_img").click(function() {
                    $("#delete_student_id").val($(this).data('student-id'))
                    $("#delete_student_name").val($(this).data('student-name'))
                    $("#delete_filename").val($(this).data('file-name'))
                    $("#delete_id").val($(this).data('id'))
                });
            });
        </script>
    @endsection
