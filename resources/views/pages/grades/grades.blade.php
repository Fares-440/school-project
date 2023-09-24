@extends('layouts.master')
@section('title')
    {{ trans('Grades_trans.List_Grade') }}
@endsection
@section('css')
    {{-- <link rel="stylesheet" href="{{ URL::asset('assets/css/plugins/toastr.css') }}"> --}}
    @toastr_css
@endsection
@section('page-header')
@section('PageTitle')
    {{ trans('Grades_trans.title_page') }}
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
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
                        {{ trans('Grades_trans.add_Grade') }}
                    </button>
                    <br><br>
                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                            style="text-align: center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('Grades_trans.Name') }}</th>
                                    <th>{{ trans('Grades_trans.Notes') }}</th>
                                    <th>{{ trans('Grades_trans.Processes') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($grades as $grade)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $grade->name }}</td>
                                        <td>{{ $grade->notes }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm edit-model" data-toggle="modal"
                                                data-target="#edit" data-id="{{ $grade->id }}"
                                                data-name-en="{{ $grade->getTranslation('name', 'en') }}"
                                                data-name-ar="{{ $grade->getTranslation('name', 'ar') }}"
                                                data-notes="{{ $grade->notes }}"
                                                title="{{ trans('Grades_trans.Edit') }}"><i
                                                    class="fa fa-edit"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm delete-model"
                                                data-toggle="modal" data-target="#delete" data-id="{{ $grade->id }}"
                                                title="{{ trans('Grades_trans.Delete') }}"><i
                                                    class="fa fa-trash"></i></button>
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
    <!-- row closed -->
    <!-- add_modal_Grade -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{ trans('Grades_trans.add_Grade') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- add_form -->
                    <form action="{{ route('grades.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="name_ar" class="mr-sm-2">{{ trans('Grades_trans.stage_name_ar') }}
                                    :</label>
                                <input id="name_ar" type="text" name="name[ar]" class="form-control"
                                    value="{{ old('name.ar') }}">
                            </div>
                            <div class="col">
                                <label for="name_en" class="mr-sm-2">{{ trans('Grades_trans.stage_name_en') }}
                                    :</label>
                                <input id="name_en" type="text" class="form-control" name="name[en]"
                                    value="{{ old('name.en') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">{{ trans('Grades_trans.Notes') }}
                                :</label>
                            <textarea class="form-control" name="notes" id="exampleFormControlTextarea1" rows="3">{{ old('notes') }}</textarea>
                        </div>
                        <br><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                    <button type="submit" class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
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
                        {{ trans('Grades_trans.edit_Grade') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- add_form -->
                    <form action="{{ route('grades.update', 'test') }}" method="post">
                        {{ method_field('patch') }}
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="edit_name_ar"
                                    class="mr-sm-2">{{ trans('Grades_trans.stage_name_ar') }}
                                    :</label>
                                <input id="edit_name_ar" type="text" name="name[ar]" class="form-control" value="">
                                <input id="edit_id" type="hidden" name="id" class="form-control">
                            </div>
                            <div class="col">
                                <label for="edit_name_en"
                                    class="mr-sm-2">{{ trans('Grades_trans.stage_name_en') }}
                                    :</label>
                                <input type="text" class="form-control" id="edit_name_en" name="name[en]">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_notes">{{ trans('Grades_trans.Notes') }}
                                :</label>
                            <textarea class="form-control" id="edit_notes" name="notes" rows="3"></textarea>
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
                        {{ trans('Grades_trans.delete_Grade') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('grades.destroy', 'test') }}" method="post">
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

@endsection
@section('js')
    <script>
        $(function() {
            $(".edit-model").click(function() {
                $("#edit_name_ar").val($(this).data('name-ar'))
                $("#edit_name_en").val($(this).data('name-en'))
                $("#edit_notes").val($(this).data('notes'))
                $("#edit_id").val($(this).data('id'))
            });
            $(".delete-model").click(function() {
                $("#delete_id").val($(this).data('id'))
            });
        });
    </script>
@endsection
