<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAllData($data, $withRelation = [], $withTrashed = false, $selectedColumns = [], $pagination = true)
    {
        $query = $this->query();
        if (count($withRelation) > 0) {
            $query->with($withRelation);
        }
        if ($withTrashed) {
            $query->withTrashed();
        }
        if (count($selectedColumns) > 0) {
            $query->select($selectedColumns);
        }
        if (isset($data->keyword) && $data->keyword !== null) {
            $query->where('name', 'LIKE', '%' . $data->keyword . '%');
        }
        if ($pagination) {
            return $query->orderBy('id', 'DESC')->paginate();
        } else {
            return $query->orderBy('id', 'DESC')->get();
        }
    }

    // find model by its identifier
    public function find($id)
    {
        return $this->model->find($id);
    }

    //store single record
    public function store($request)
    {
        return $this->model->create($request->except('_token'));
    }

    public function update($request, $id)
    {
        $update = $this->itemByIdentifier($id);
        $data = $request->except('_token');
        $update->fill($data)->save();
        $update = $this->itemByIdentifier($id);
        return $update;
    }

    public function delete($request, $id)
    {
        $item = $this->itemByIdentifier($id);
        return $item->delete();
    }

    public function itemByIdentifier($id)
    {
        try {
            return $this->model->findOrFail($id);
        } catch (\Exception $e) {
            throw new ResourceNotFoundException();
        }
    }

    public function query()
    {
        return $this->model->query();
    }

    public function restoreDeleted($id)
    {
        $record =  $this->query()->withTrashed()->where('id', $id)->firstOrFail();
        $record->restore();
    }

    public function deletePermanently($id)
    {
        $record =  $this->query()->withTrashed()->where('id', $id)->firstOrFail();
        $record->forceDelete();
    }
}
