<?php


namespace App\Traits\CrudTraits;


trait StatusTrait
{

    public function status($id)
    {
        $model = $this->repository->show($id);

        $model->is_active = !$model->is_active;

        $model->save();

        return $this->sendSuccess(trans("messages.status-$model->is_active", ['model' => $this->translated_module_name]));
    }
}
