<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait DatabaseOperationsTrait
{
    /**
     * Store data in a given model.
     *
     * @param Model $model
     * @param array $data
     * @return Model
     */
    public function storeRecord(Model $model, array $data)
    {
        return $model->create($data);
    }

    /**
     * Update a record in the given model.
     *
     * @param Model $model
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateRecord(Model $model, int $id, array $data)
    {
        $record = $model->find($id);

        if ($record) {
            return $record->update($data);
        }

        return false;
    }

    /**
     * Delete a record in the given model.
     *
     * @param Model $model
     * @param int $id
     * @return bool|null
     */
    public function deleteRecord(Model $model, int $id)
    {
        $record = $model->find($id);

        if ($record) {
            return $record->delete();
        }

        return false;
    }

    /**
     * Retrieve a record by ID from the given model.
     *
     * @param Model $model
     * @param int $id
     * @return Model|null
     */
    public function getRecord(Model $model, int $id)
    {
        return $model->find($id);
    }

    /**
     * Retrieve all the records from the given model.
     *
     * @param Model $model
     * @param 
     * @return Model|null
     */
    public function getRecords(Model $model)
    {
        return $model->all();
    }
}
