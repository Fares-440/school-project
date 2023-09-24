<button class="btn btn-success btn-sm btn-lg pull-right" wire:click="showformadd"
    type="button">{{ trans('Parent_trans.add_parent') }}</button><br><br>
<div class="table-responsive">
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
        style="text-align: center">
        <thead>
            <tr class="table-success">
                <th>#</th>
                <th>{{ trans('Parent_trans.Email') }}</th>
                <th>{{ trans('Parent_trans.Name_Father') }}</th>
                <th>{{ trans('Parent_trans.National_ID_Father') }}</th>
                <th>{{ trans('Parent_trans.Passport_ID_Father') }}</th>
                <th>{{ trans('Parent_trans.Phone_Father') }}</th>
                <th>{{ trans('Parent_trans.Job_Father') }}</th>
                <th>{{ trans('Parent_trans.Processes') }}</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($parents as $parent)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $parent->email }}</td>
                    <td>{{ $parent->father_name }}</td>
                    <td>{{ $parent->national_id_father }}</td>
                    <td>{{ $parent->passport_id_father }}</td>
                    <td>{{ $parent->phone_father }}</td>
                    <td>{{ $parent->job_father }}</td>
                    <td>
                        <button wire:click="edit({{ $parent->id }})" title="{{ trans('Grades_trans.Edit') }}"
                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-danger btn-sm" wire:click="delete({{ $parent->id }})"
                            title="{{ trans('Grades_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            @endforeach
    </table>
</div>
