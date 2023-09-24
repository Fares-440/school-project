<?php

namespace App\Interfaces;

interface TeacherRepositoryInterface
{

    // get all Teachers
    public function getAllTeachers();
    public function specializations();
    public function genders();
    public function store($teacher);
    public function edit($id);
    public function update($teacher);
    public function destory($id);
}
