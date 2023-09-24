@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('Sections_trans.title_page') }}
@stop
@endsection
@section('page-header')
@section('PageTitle')
{{ trans('main_trans.sections') }}
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <a class="button x-small" href="#" data-toggle="modal" data-target="#exampleModal">
                    {{ trans('Sections_trans.add_section') }}</a>
            </div>

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

            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="accordion gray plus-icon round">

                        @foreach ($grades as $grade)
                            <div class="acd-group">
                                <a href="#" class="acd-heading">{{ $grade->name }}</a>
                                <div class="acd-des">

                                    <div class="row">
                                        <div class="col-xl-12 mb-30">
                                            <div class="card card-statistics h-100">
                                                <div class="card-body">
                                                    <div class="d-block d-md-flex justify-content-between">
                                                        <div class="d-block">
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive mt-15">
                                                        <table class="table center-aligned-table mb-0">
                                                            <thead>
                                                                <tr class="text-dark">
                                                                    <th>#</th>
                                                                    <th>{{ trans('Sections_trans.Name_Section') }}
                                                                    </th>
                                                                    <th>{{ trans('Sections_trans.Name_Class') }}</th>
                                                                    <th>{{ trans('Sections_trans.Status') }}</th>
                                                                    <th>{{ trans('Sections_trans.Processes') }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($grade->sections as $section)
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td>{{ $section->name }}</td>
                                                                        <td>{{ $section->classroom->name }}
                                                                        </td>
                                                                        <td>
                                                                            @if ($section->status === 1)
                                                                                <label
                                                                                    class="badge badge-success">{{ trans('Sections_trans.Status_Section_AC') }}</label>
                                                                            @else
                                                                                <label
                                                                                    class="badge badge-danger">{{ trans('Sections_trans.Status_Section_No') }}</label>
                                                                            @endif

                                                                        </td>
                                                                        <td>
                                                                            <a href="#"
                                                                                class="btn btn-outline-info btn-sm edit-model"
                                                                                data-toggle="modal" data-target="#edit"
                                                                                data-id="{{ $section->id }}"
                                                                                data-name-ar="{{ $section->getTranslation('name', 'ar') }}"
                                                                                data-name-en="{{ $section->getTranslation('name', 'en') }}"
                                                                                data-grade-id="{{ $section->grade_id }}"
                                                                                data-classroom-id="{{ $section->classroom_id }}"
                                                                                data-edit-check="{{ $section->status }}"
                                                                                data-teacher_id="{{ $section->teachers }}">{{ trans('Sections_trans.Edit') }}</a>
                                                                            <a href="#"
                                                                                class="btn btn-outline-danger btn-sm delete-model"
                                                                                data-toggle="modal"
                                                                                data-id="{{ $section->id }}"
                                                                                data-target="#delete">{{ trans('Sections_trans.Delete') }}</a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--اضافة قسم جديد -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;" id="exampleModalLabel">
                    {{ trans('Sections_trans.add_section') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('sections.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <input type="text" name="name[ar]" class="form-control"
                                placeholder="{{ trans('Sections_trans.Section_name_ar') }}">
                        </div>

                        <div class="col">
                            <input type="text" name="name[en]" class="form-control"
                                placeholder="{{ trans('Sections_trans.Section_name_en') }}">
                        </div>

                    </div>
                    <br>


                    <div class="col">
                        <label for="inputName"
                            class="control-label">{{ trans('Sections_trans.Name_Grade') }}</label>
                        <select name="grade_id" class="custom-select" onchange="console.log($(this).val())">
                            <!--placeholder-->
                            <option value="" selected disabled>{{ trans('Sections_trans.Select_Grade') }}
                            </option>
                            @foreach ($grades as $grade)
                                <option value="{{ $grade->id }}"> {{ $grade->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <br>

                    <div class="col">
                        <label for="inputName"
                            class="control-label">{{ trans('Sections_trans.Name_Class') }}</label>
                        <select name="classroom_id" class="custom-select">
                        </select>
                    </div>
                    <div class="col">
                        <label for="inputName"
                            class="control-label">{{ trans('Sections_trans.Name_Teacher') }}</label>
                        <select multiple name="teacher_id[]" class="form-control" id="exampleFormControlSelect2">
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{ trans('Sections_trans.Close') }}</button>
                <button type="submit" class="btn btn-danger">{{ trans('Sections_trans.submit') }}</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--تعديل قسم جديد -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="model-edit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;" id="model-edit">
                    {{ trans('Sections_trans.edit_Section') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('sections.update', 'test') }}" method="POST">
                    {{ method_field('patch') }}
                    @csrf
                    <div class="row">
                        <div class="col">
                            <input type="text" id="edit_name_ar" name="name[ar]" class="form-control">
                        </div>
                        <div class="col">
                            <input type="text" id="edit_name_en" name="name[en]" class="form-control">
                            <input id="edit_id" type="hidden" name="id" class="form-control">
                        </div>
                    </div>
                    <br>

                    <div class="col">
                        <label for="inputName"
                            class="control-label">{{ trans('Sections_trans.Name_Grade') }}</label>
                        <select name="grade_id" id="edit_grade_id" class="custom-select"
                            onclick="console.log($(this).val())">
                            <!--placeholder-->
                            <option value="" selected disabled>{{ trans('Sections_trans.Select_Grade') }}
                                @foreach ($grades as $grade)
                            <option value="{{ $grade->id }}">
                                {{ $grade->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <br>

                    <div class="col">
                        <label for="edit_classroom_id"
                            class="control-label">{{ trans('Sections_trans.Name_Class') }}</label>
                        <select name="classroom_id" id="edit_classroom_id" class="custom-select">
                        </select>
                    </div>

                    <div class="col">
                        <label for="edit_teacher_id"
                            class="control-label">{{ trans('Sections_trans.Name_Teacher') }}</label>
                        <select multiple name="teacher_id[]" class="form-control" id="edit_teacher_id">
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <br>

                    <div class="col">
                        <div class="form-check">

                            <input type="checkbox" class="form-check-input" name="status" id="edit_check">

                            <label class="form-check-label"
                                for="edit_check">{{ trans('Sections_trans.Status') }}</label>
                        </div>
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{ trans('Sections_trans.Close') }}</button>
                <button type="submit" class="btn btn-danger">{{ trans('Sections_trans.submit') }}</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- delete_modal_Grade -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('Sections_trans.delete_Section') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sections.destroy', 'test') }}" method="post">
                    {{ method_field('Delete') }}
                    @csrf
                    {{ trans('Sections_trans.Warning_Section') }}
                    <input id="delete_id" type="hidden" name="id" class="form-control">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('Sections_trans.Close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ trans('Sections_trans.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
<script>
    function ajaxsections(Grade_id, classroom_id = null) {
        $.ajax({
            url: "{{ URL::to('classrooms') }}/" + Grade_id,
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('select[name="classroom_id"]').empty();
                $.each(data.classroom, function(key, value) {
                    $('select[name="classroom_id"]').append(
                        `<option value="${key}" ${(classroom_id !== null && key == classroom_id )?"selected":''}>${value}</option>`
                    );
                });
            },
        });
    }
    $(document).ready(function() {
        $('select[name="grade_id"]').on('change', function() {
            var Grade_id = $(this).val();
            if (Grade_id) {
                ajaxsections(Grade_id);
            } else {
                console.log('AJAX load did not work');
            }
        });

        $(".edit-model").click(function() {
            $("#edit_name_ar").val($(this).data('name-ar'))
            $("#edit_name_en").val($(this).data('name-en'))
            $("#edit_id").val($(this).data('id'))
            $("#edit_grade_id").val($(this).data('grade-id'))
            ajaxsections($(this).data('grade-id'), $(this).data('classroom-id'));
            ($(this).data('edit-check') == 1) ? $("#edit_check").attr('checked', true): $("#edit_check")
                .attr('checked', false);
                $('select[id="edit_teacher_id"] option').attr('selected', false)
            $.each($(this).data('teacher_id'), function(key, value) {
                $.each($('select[id="edit_teacher_id"] option'), function(option_key,
                    option_value) {
                        console.log($(option_value).val() == value.pivot.teacher_id)
                    if ($(option_value).val() == value.pivot.teacher_id) {
                        $(option_value).attr('selected', true)

                    }
                })
            })

        });
        $(".delete-model").click(function() {
            $("#delete_id").val($(this).data('id'))
        });
    });
</script>
@endsection
