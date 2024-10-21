<?php

namespace Modules\Admins\Http\Controllers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;
use Modules\Admins\Entities\User;
use Modules\Admins\Http\Filters\SelectFilter;
use Modules\Admins\Transformers\SelectResource;

class SelectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param SelectFilter $filter
     * @return AnonymousResourceCollection
     */
    public function index(SelectFilter $filter)
    {
        $users = User::filter($filter)->whereNull('type')->get();

        return SelectResource::collection($users);
    }
}
