<?php

namespace Modules\Admins\Entities\Presenters;

use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter
{
    /**
     * Display the localed type.
     *
     * @return string
     */
    public function type()
    {
        return trans('admins::users.types.'.$this->entity->type);
    }
}
