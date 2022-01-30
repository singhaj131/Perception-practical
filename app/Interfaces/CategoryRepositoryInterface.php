<?php

namespace App\Interfaces;

interface CategoryRepositoryInterface
{
    public function getAllData($request);
    public function getParentCategory();
    public function find($id);
    public function getSingleItem($id);
    public function store($request);
    public function update($request, $id);
    public function delete($request, $id);
    public function restoreDeleted($id);
    public function deletePermanently($id);
}
