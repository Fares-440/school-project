<?php

namespace App\Interfaces;

interface StudentGraduatedRepositoryInterface
{
    public function index();
    public function create();
    public function softDelete($request);
    public function returnData($request);
    public function destroy($request);
}
