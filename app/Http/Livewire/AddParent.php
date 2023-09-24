<?php

namespace App\Http\Livewire;

use App\Models\MyParent;
use App\Models\Nationalitie;
use App\Models\ParentAttachment;
use App\Models\Religion;
use App\Models\TypeBlood;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddParent extends Component
{
    use WithFileUploads;


    public $currentStep = 1,
        $catchError,
        $photos = [],
        $updateMode = false,
        $show_table = true,
        $successMessage = '',
        // Father_INPUTS
        $parentid,
        $email, $password,
        $father_name, $father_name_en,
        $father_nationality_id, $passport_id_father,
        $phone_father, $job_father, $job_father_en,
        $national_id_father, $father_bloodtype_id,
        $father_address, $father_religion_id,

        // Mother_INPUTS
        $Name_Mother, $Name_Mother_en,
        $National_ID_Mother, $Passport_ID_Mother,
        $Phone_Mother, $Job_Mother, $Job_Mother_en,
        $Nationality_Mother_id, $Blood_Type_Mother_id,
        $Address_Mother, $Religion_Mother_id;

    protected $rules = [
        'father_name' => 'required|min:6',
        'father_name_en' => 'required|min:6',
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'email' => "required|email|unique:parents,email,$this->parentid,id",
            'national_id_father' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'passport_id_father' => 'min:10|max:10',
            'phone_father' => 'min:10|regex:/^([0-9\s\-\+\(\)]*)$/',
            'National_ID_Mother' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'Passport_ID_Mother' => 'min:10|max:10',
            'Phone_Mother' => 'min:10|regex:/^([0-9\s\-\+\(\)]*)$/',
            'photos.*' => "image|max:1024"
        ]);
    }
    public function render()
    {
        return view('livewire.add-parent', [
            'nationalities' => Nationalitie::all(),
            'typeboolds' => TypeBlood::all(),
            'religions' => Religion::all(),
            'parents' => MyParent::all(),
        ]);
    }
    //firstStepSubmit
    public function firstStepSubmit()
    {
        $this->validate([
            'email' => "required|email|unique:parents,email,$this->parentid,id",
            'password' => empty($this->parentid) ? "required" : 'nullable',
            'father_name' => 'required',
            'father_name_en' => 'required',
            'job_father' => 'required',
            'job_father_en' => 'required',
            'national_id_father' => 'required|unique:parents,national_id_father,' . $this->parentid,
            'father_religion_id' => 'required|unique:parents,father_religion_id,' . $this->parentid,
            'phone_father' => 'required|min:10|regex:/^([0-9\s\-\+\(\)]*)$/',
            'father_nationality_id' => 'required',
            'father_bloodtype_id' => 'required',
            'father_religion_id' => 'required',
            'father_address' => 'required',
        ]);
        // $this->updateMode = !empty($this->parentid) ? true : false;
        $this->currentStep = 2;
    }

    //secondStepSubmit
    public function secondStepSubmit()
    {
        $this->validate([
            'Name_Mother' => 'required',
            'Name_Mother_en' => 'required',
            'National_ID_Mother' => 'required|unique:parents,national_id_mother,' . $this->parentid,
            'Religion_Mother_id' => 'required|unique:parents,father_religion_id,' . $this->parentid,
            'Phone_Mother' => 'required',
            'Job_Mother' => 'required',
            'Job_Mother_en' => 'required',
            'Nationality_Mother_id' => 'required',
            'Blood_Type_Mother_id' => 'required',
            'Religion_Mother_id' => 'required',
            'Address_Mother' => 'required',
        ]);
        // $this->updateMode = !empty($this->parentid) ? true : false;
        $this->currentStep = 3;
    }


    //back
    public function back($step)
    {
        $this->currentStep = $step;
    }
    public function submitForm()
    {
        try {
            $parent = MyParent::updateOrCreate(['id' => $this->parentid], [
                // $parent = MyParent::create([
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'father_name' => [
                    'ar' => $this->father_name,
                    'en' => $this->father_name_en,
                ],
                'national_id_father' => $this->national_id_father,
                'passport_id_father' => $this->passport_id_father,
                'phone_father' => $this->phone_father,
                'job_father' => [
                    'ar' => $this->job_father,
                    'en' => $this->job_father_en,
                ],
                'father_nationality_id' => $this->father_nationality_id,
                'father_bloodtype_id' => $this->father_bloodtype_id,
                'father_religion_id' => $this->father_religion_id,
                'father_address' => $this->father_address,
                'mother_name' => [
                    'ar' => $this->Name_Mother,
                    'en' => $this->Name_Mother_en,
                ],
                'national_id_mother' => $this->National_ID_Mother,
                'passport_id_mother' => $this->Passport_ID_Mother,
                'phone_mother' => $this->Phone_Mother,
                'job_mother' => [
                    'ar' => $this->Job_Mother,
                    'en' => $this->Job_Mother_en,
                ],
                'mother_nationality_id' => $this->Nationality_Mother_id,
                'mother_bloodtype_id' => $this->Blood_Type_Mother_id,
                'mother_religion_id' => $this->Religion_Mother_id,
                'mother_address' => $this->Address_Mother,
            ]);

            if (!empty($this->photos)) {
                foreach ($this->photos as $photo) {
                    $photo->storeAs($parent->id, $photo->getClientOriginalName(), 'parent_attachments');
                    ParentAttachment::create([
                        'file_name' => $photo->getClientOriginalName(),
                        'parent_id' => $parent->id,
                    ]);
                }
            }
            $this->successMessage = !empty($this->parentid) ? trans('messages.Update') : trans('messages.success');
            $this->clearForm();
            $this->show_table = true;
            $this->currentStep = 1;
        } catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        };
    }
    //clearForm
    public function clearForm()
    {
        $this->parentid = '';
        $this->email = '';
        $this->password = '';
        $this->father_name = '';
        $this->father_name_en = '';
        $this->national_id_father = '';
        $this->passport_id_father = '';
        $this->phone_father = '';
        $this->job_father = '';
        $this->job_father_en = '';
        $this->father_nationality_id = '';
        $this->father_religion_id = '';
        $this->father_address = '';
        $this->Name_Mother = '';
        $this->Name_Mother_en = '';
        $this->National_ID_Mother = '';
        $this->Passport_ID_Mother = '';
        $this->Phone_Mother = '';
        $this->Job_Mother = '';
        $this->Job_Mother_en = '';
        $this->Nationality_Mother_id = '';
        $this->Blood_Type_Mother_id = '';
        $this->Religion_Mother_id = '';
        $this->Address_Mother = '';
    }

    public function showformadd()
    {
        $this->show_table = false;
    }
    public function edit($id)
    {
        $parent = MyParent::whereId($id)->first();
        $this->show_table = false;
        $this->parentid = $parent->id;
        $this->email = $parent->email;
        // $this->password = $parent->password;
        $this->father_name = $parent->getTranslation('father_name', 'ar');
        $this->father_name_en = $parent->getTranslation('father_name', 'en');
        $this->national_id_father = $parent->national_id_father;
        $this->passport_id_father = $parent->passport_id_father;
        $this->phone_father = $parent->phone_father;
        $this->job_father = $parent->getTranslation('job_father', 'ar');
        $this->job_father_en = $parent->getTranslation('job_father', 'en');
        $this->father_nationality_id = $parent->father_nationality_id;
        $this->father_bloodtype_id = $parent->father_bloodtype_id;
        $this->father_religion_id = $parent->father_religion_id;
        $this->father_address = $parent->father_address;
        $this->Name_Mother = $parent->getTranslation('mother_name', 'ar');
        $this->Name_Mother_en = $parent->getTranslation('mother_name', 'en');
        $this->National_ID_Mother = $parent->national_id_mother;
        $this->Passport_ID_Mother = $parent->passport_id_mother;
        $this->Phone_Mother = $parent->phone_mother;
        $this->Job_Mother = $parent->getTranslation('job_mother', 'ar');
        $this->Job_Mother_en = $parent->getTranslation('job_mother', 'en');
        $this->Nationality_Mother_id = $parent->mother_nationality_id;
        $this->Blood_Type_Mother_id = $parent->mother_bloodtype_id;
        $this->Religion_Mother_id = $parent->mother_religion_id;
        $this->Address_Mother = $parent->mother_address;
    }

    public function delete($id)
    {
        $parent = MyParent::with('photos')->find($id);

        if ($parent) {
            if (Storage::disk('parent_attachments')->exists($parent->id)) {
                Storage::disk('parent_attachments')->deleteDirectory($parent->id);
            }
            $parent->delete();
            $this->catchError = "";
            $this->successMessage = trans("messages.Delete");
        } else {
            $this->successMessage = '';
            $this->catchError = trans("معلوماتك خاطئة");
        }

        $this->show_table = true;
    }
}
