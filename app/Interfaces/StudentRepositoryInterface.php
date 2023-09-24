<?php

namespace App\Interfaces;

interface StudentRepositoryInterface
{

    // get all Students
    public function getAllStudents();
    public function nationalitie();
    public function genders();
    public function grades();
    public function bloods();
    public function classes();
    public function parents();
    public function store($student);
    public function edit($id);
    public function show($id);
    public function update($student);
    public function destory($id);
    public function getImage($file, $name);
    public function downloadImage($file, $name);
    public function deleteImage($request);
    public function uploadImage($request);
}
