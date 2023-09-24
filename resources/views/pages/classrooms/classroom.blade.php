@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('My_Classes_trans.title_page') }}
@stop
@endsection
@section('page-header')
@section('PageTitle')
{{ trans('My_Classes_trans.List_classes') }} /
{{ trans('main_trans.classes') }}
@endsection
@section('content')
<!-- row -->
<div class="row">

    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                    {{ trans('My_Classes_trans.add_class') }}
                </button>

                <button type="button" class="button x-small" id="btn_delete_all">
                    {{ trans('My_Classes_trans.delete_checkbox') }}
                </button>


                <form action="
                {{ route('classrooms.filter_classes') }}
                " method="POST" class="btn">
                    {{ csrf_field() }}
                    <select class="selectpicker button x-small" data-style="btn-info" name="grade_id_filter" required
                        onchange="this.form.submit()">
                        <option value="" selected disabled>{{ trans('My_Classes_trans.Search_By_Grade') }}</option>
                        @foreach ($grades as $grade)
                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                        @endforeach
                    </select>
                </form>

                <br><br><br><br>

                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" id="all_delete" class="box1">
                                </th>
                                <th>#</th>
                                <th>{{ trans('My_Classes_trans.Name_class') }}</th>
                                <th>{{ trans('My_Classes_trans.Name_Grade') }}</th>
                                <th>{{ trans('My_Classes_trans.Processes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($details))
                                @php
                                    $list = $details;
                                @endphp
                            @else
                                @php
                                    $list = $classrooms;
                                @endphp
                            @endif
                            @foreach ($list as $classroom)
                                <tr>
                                    <td><input type="checkbox" value="{{ $classroom->id }}" class="box1">
                                    </td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $classroom->name }}</td>
                                    <td>{{ $classroom->grade->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm edit-model" data-toggle="modal"
                                            data-target="#edit"
                                            data-name-ar="{{ $classroom->getTranslation('name', 'ar') }}"
                                            data-name-en="{{ $classroom->getTranslation('name', 'en') }}"
                                            data-id="{{ $classroom->id }}"
                                            data-grade-id="{{ $classroom->grade->id }}"
                                            title="{{ trans('Grades_trans.Edit') }}"><i
                                                class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm delete-model"
                                            data-toggle="modal" data-target="#delete" data-id="{{ $classroom->id }}"
                                            title="{{ trans('Grades_trans.Delete') }}"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                    </table>
                    <div class="d-flex flex-row-reverse">
                        {{$classrooms->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- add_modal_class -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="addmodal"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="addmodal">
                        {{ trans('My_Classes_trans.add_class') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class=" row mb-30" action="{{ route('classrooms.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="repeater">
                                <div data-repeater-list="list_classes">
                                    <div data-repeater-item>
                                        <div class="row">
                                            <div class="col">
                                                <label for="name_ar"
                                                    class="mr-sm-2">{{ trans('My_Classes_trans.Name_class') }}
                                                    :</label>
                                                <input class="form-control" type="text" id="name_ar" name="name_ar" />
                                            </div>


                                            <div class="col">
                                                <label for="name_en"
                                                    class="mr-sm-2">{{ trans('My_Classes_trans.Name_class_en') }}
                                                    :</label>
                                                <input class="form-control" id="name_en" type="text" name="name_en" />
                                            </div>


                                            <div class="col">
                                                <label for="grade_id"
                                                    class="mr-sm-2">{{ trans('My_Classes_trans.Name_Grade') }}
                                                    :</label>

                                                <div class="box">
                                                    <select class="fancyselect" name="grade_id" id="grade_id">
                                                        @foreach ($grades as $grade)
                                                            <option value="{{ $grade->id }}">{{ $grade->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col">
                                                <label for="Name_en"
                                                    class="mr-sm-2">{{ trans('My_Classes_trans.Processes') }}
                                                    :</label>
                                                <input class="btn btn-danger btn-block" data-repeater-delete
                                                    type="button"
                                                    value="{{ trans('My_Classes_trans.delete_row') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-20">
                                    <div class="col-12">
                                        <input class="button" data-repeater-create type="button"
                                            value="{{ trans('My_Classes_trans.add_row') }}" />
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                    <button type="submit"
                                        class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                                </div>


                            </div>
                        </div>
                    </form>
                </div>


            </div>

        </div>

    </div>
</div>



<!-- حذف مجموعة صفوف -->
<div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('My_Classes_trans.delete_class') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="
            {{ route('classrooms.delete_all') }}
            " method="POST">
                @csrf
                <div class="modal-body">
                    {{ trans('My_Classes_trans.Warning_Grade') }}
                    <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ trans('My_Classes_trans.Close') }}</button>
                    <button type="submit" class="btn btn-danger">{{ trans('My_Classes_trans.submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- edit_modal_Grade -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('My_Classes_trans.edit_class') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- edit_form -->
                <form action="{{ route('classrooms.update', 'test') }}" method="post">
                    {{ method_field('patch') }}
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="edit_name_ar"
                                class="mr-sm-2">{{ trans('My_Classes_trans.Name_class') }}
                                :</label>
                            <input id="edit_name_ar" type="text" name="name_ar" class="form-control">
                            <input id="edit_id" type="hidden" name="id" class="form-control">
                        </div>
                        <div class="col">
                            <label for="edit_name_en"
                                class="mr-sm-2">{{ trans('My_Classes_trans.Name_class_en') }}
                                :</label>
                            <input type="text" class="form-control" id="edit_name_en" name="name_en">
                        </div>
                    </div><br>
                    <div class="form-group">
                        <label for="eidt_grade_id">{{ trans('My_Classes_trans.Name_Grade') }}
                            :</label>
                        <select class="form-control form-control-lg" id="eidt_grade_id" name="grade_id">
                            @foreach ($grades as $grade)
                                <option value="{{ $grade->id }}">
                                    {{ $grade->getTranslation('name', 'ar') }}
                                </option>
                            @endforeach
                        </select>

                    </div>
                    <br><br>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                        <button type="submit" class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                    </div>
                </form>

            </div>
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
                    {{ trans('My_Classes_trans.delete_class') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('classrooms.destroy', 'test') }}" method="post">
                    {{ method_field('Delete') }}
                    @csrf
                    {{ trans('Grades_trans.Warning_Grade') }}
                    <div class="form-group">
                        <input id="delete_id" type="hidden" name="id" class="form-control" <div
                            class="modal-footer">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ trans('Grades_trans.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- row closed -->
@endsection
@section('js')
<script type="text/javascript">
    $(function() {
        $("#all_delete").click(function() {
            if ($(this).is(":checked")) {
                $("#datatable tbody input[type=checkbox]").each(function() {
                    $(this).attr('checked', true)
                });
            } else {
                $("#datatable tbody input[type=checkbox]").each(function() {
                    $(this).attr('checked', false)
                });
            }

        })
        $("#btn_delete_all").click(function() {
            var selected = [];
            $("#datatable tbody input[type=checkbox]:checked").each(function() {
                selected.push(this.value);
            });
            if (selected.length > 0) {
                $('#delete_all').modal('show')
                $('input[id="delete_all_id"]').val(selected);
            }
        });

        $(".edit-model").click(function() {
            $("#edit_name_ar").val($(this).data('name-ar'))
            $("#edit_name_en").val($(this).data('name-en'))
            $("#edit_id").val($(this).data('id'))
            $(`#eidt_grade_id option[value=${$(this).data('grade-id')}]`).prop('selected', true)
        });
        $(".delete-model").click(function() {
            $("#delete_id").val($(this).data('id'))
        });
    });
</script>
@endsection
