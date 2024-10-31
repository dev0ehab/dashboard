<?php

namespace Modules\Accounts\Contracts\Interfaces;

interface CrudsInterface
{
    /**
     * Get index models as a collection.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection
     */
    public function index();

    /**
     * Save the created model to storage.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data);

    /**
     * Display the given id instance.
     *
     * @param mixed $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function show($id, $withTrashed = false);

    /**
     * Update the given model in the storage.
     *
     * @param mixed $model
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($model, array $data);

    /**
     * Delete the given model from storage.
     *
     * @param mixed $model
     * @return void
     */
    public function delete($model);
}
