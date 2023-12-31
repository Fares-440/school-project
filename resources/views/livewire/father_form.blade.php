@if ($currentStep != 1)
    <div style="display: none" class="row setup-content" id="step-1">
@endif
<div class="col-xs-12">
    <div class="col-md-12">
        <br>
        <div class="form-row">
            <div class="col">
                <label for="title">{{ trans('Parent_trans.Email') }}</label>
                <input type="email" wire:model="email" class="form-control">
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col">
                <label for="title">{{ trans('Parent_trans.Password') }}</label>
                <input type="password" wire:model="password" class="form-control">
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="col">
                <label for="title">{{ trans('Parent_trans.Name_Father') }}</label>
                <input type="text" wire:model="father_name" class="form-control">
                @error('father_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col">
                <label for="title">{{ trans('Parent_trans.Name_Father_en') }}</label>
                <input type="text" wire:model="father_name_en" class="form-control">
                @error('father_name_en')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-3">
                <label for="title">{{ trans('Parent_trans.Job_Father') }}</label>
                <input type="text" wire:model="job_father" class="form-control">
                @error('job_father')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-3">
                <label for="title">{{ trans('Parent_trans.Job_Father_en') }}</label>
                <input type="text" wire:model="job_father_en" class="form-control">
                @error('job_father_en')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col">
                <label for="title">{{ trans('Parent_trans.National_ID_Father') }}</label>
                <input type="text" wire:model="national_id_father" class="form-control">
                @error('national_id_father')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col">
                <label for="title">{{ trans('Parent_trans.Passport_ID_Father') }}</label>
                <input type="text" wire:model="passport_id_father" class="form-control">
                @error('passport_id_father')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col">
                <label for="title">{{ trans('Parent_trans.Phone_Father') }}</label>
                <input type="text" wire:model="phone_father" class="form-control">
                @error('phone_father')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>


        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">{{ trans('Parent_trans.Nationality_Father_id') }}</label>
                <select class="custom-select my-1 mr-sm-2" wire:model="father_nationality_id">
                    <option selected>{{ trans('Parent_trans.Choose') }}...</option>
                    @foreach ($nationalities as $nationalty)
                        <option value="{{ $nationalty->id }}">{{ $nationalty->name }}</option>
                    @endforeach
                </select>
                @error('father_nationality_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col">
                <label for="inputState">{{ trans('Parent_trans.Blood_Type_Father_id') }}</label>
                <select class="custom-select my-1 mr-sm-2" wire:model="father_bloodtype_id">
                    <option selected>{{ trans('Parent_trans.Choose') }}...</option>
                    @foreach ($typeboolds as $typeboold)
                        <option value="{{ $typeboold->id }}">{{ $typeboold->name }}</option>
                    @endforeach
                </select>
                @error('father_bloodtype_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col">
                <label for="inputZip">{{ trans('Parent_trans.Religion_Father_id') }}</label>
                <select class="custom-select my-1 mr-sm-2" wire:model="father_religion_id">
                    <option selected>{{ trans('Parent_trans.Choose') }}...</option>
                    @foreach ($religions as $religion)
                        <option value="{{ $religion->id }}">{{ $religion->name }}</option>
                    @endforeach
                </select>
                @error('father_religion_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>


        <div class="form-group">
            <label for="exampleFormControlTextarea1">{{ trans('Parent_trans.Address_Father') }}</label>
            <textarea class="form-control" wire:model="father_address" id="exampleFormControlTextarea1" rows="4"></textarea>
            @error('father_address')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="firstStepSubmit"
            type="button">{{ trans('Parent_trans.Next') }}
        </button>

    </div>
</div>
</div>
