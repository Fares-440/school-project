@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('main_trans.Students_Promotions') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main_trans.Students_Promotions') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">

    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <h6 style="color: red;font-family: Cairo">المرحلة الدراسية القديمة</h6><br>

                <form method="post" action="{{ route('promotions.store') }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group  col-md-3 col-sm-6">
                            <label for="inputState">{{ trans('Students_trans.Grade') }}</label>
                            <select class="custom-select mr-sm-2" name="grade_id">
                                <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                @foreach ($grades as $grade)
                                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                @endforeach
                            </select>
                            @error('grade_id')
                                <div class="text-danger text-bold fs-4">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group  col-md-3 col-sm-6">
                            <label for="Classroom_id">{{ trans('Students_trans.classrooms') }} : <span
                                    class="text-danger">*</span></label>
                            <select class="custom-select mr-sm-2" name="classroom_id">

                            </select>
                            @error('classroom_id')
                                <div class="text-danger text-bold fs-4">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-3 col-sm-6">
                            <label for="section_id">{{ trans('Students_trans.section') }} : </label>
                            <select class="custom-select mr-sm-2" name="section_id">

                            </select>
                            @error('section_id')
                                <div class="text-danger text-bold fs-4">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                            <label for="academic_year">{{ trans('Students_trans.academic_year') }} : <span
                                    class="text-danger">*</span></label>
                            <select class="custom-select mr-sm-2" name="academic_year">
                                <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                @php
                                    $current_year = date('Y');
                                @endphp
                                @for ($year = $current_year; $year <= $current_year + 1; $year++)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                            @error('academic_year')
                                <div class="text-danger text-bold fs-4">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <h6 style="color: red;font-family: Cairo">المرحلة الدراسية الجديدة</h6><br>

                    <div class="form-row">
                        <div class="form-group  col-md-3 col-sm-6">
                            <label for="inputState">{{ trans('Students_trans.Grade') }}</label>
                            <select class="custom-select mr-sm-2" name="grade_id_new">
                                <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                @foreach ($grades as $grade)
                                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                @endforeach
                            </select>
                            @error('grade_id_new')
                                <div class="text-danger text-bold fs-4">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group  col-md-3 col-sm-6">
                            <label for="Classroom_id">{{ trans('Students_trans.classrooms') }}: <span
                                    class="text-danger">*</span></label>
                            <select class="custom-select mr-sm-2" name="classroom_id_new">

                            </select>
                            @error('classroom_id_new')
                                <div class="text-danger text-bold fs-4">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group  col-md-3 col-sm-6">
                            <label for="section_id">:{{ trans('Students_trans.section') }} </label>
                            <select class="custom-select mr-sm-2" name="section_id_new">

                            </select>
                            @error('section_id_new')
                                <div class="text-danger text-bold fs-4">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group  col-md-3 col-sm-6">
                            <label for="academic_year">{{ trans('Students_trans.academic_year') }} : <span
                                    class="text-danger">*</span></label>
                            <select class="custom-select mr-sm-2" name="academic_year_new">
                                <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                @php
                                    $current_year = date('Y');
                                @endphp
                                @for ($year = $current_year; $year <= $current_year + 1; $year++)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                            @error('academic_year_new')
                                <div class="text-danger text-bold fs-4">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">تاكيد</button>
                </form>

            </div>
        </div>
    </div>

</div>
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@include('layouts.script')
@endsection
