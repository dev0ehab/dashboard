<?php

namespace Modules\Admins\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Modules\Admins\Entities\User;
use Modules\Admins\Http\Requests\UserRequest;
use Modules\Admins\Repositories\UserRepository;

class UserController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * The repository instance.
     *
     * @var UserRepository
     */
    private $repository;

    /**
     * AdminController constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->middleware('permission:read_users')->only(['index']);
        $this->middleware('permission:create_users')->only(['create', 'store']);
        $this->middleware('permission:update_users')->only(['edit', 'update']);
        $this->middleware('permission:delete_users')->only(['destroy']);
        $this->middleware('permission:show_users')->only(['show']);
        $this->middleware('permission:readTrashed_users')->only(['trashed']);
        $this->middleware('permission:restore_users')->only(['store']);
        $this->middleware('permission:forceDelete_users')->only(['forceDelete']);
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $users = $this->repository->all();

        return view('admins::users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admins::users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function store(UserRequest $request)
    {
        // dd($request->all());
        $user = $this->repository->create($request->allWithHashedPassword());

        flash(trans('admins::user.messages.created'))->success();

        return redirect()->route('dashboard.users.show', $user);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Application|Factory|View
     */
    public function show(User $user)
    {
        $user = $this->repository->find($user);

        return view('admins::users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Application|Factory|View
     */
    public function edit(User $user)
    {
        $user = $this->repository->find($user);

        return view('admins::users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $user
     * @return RedirectResponse
     * @throws Exception
     */
    public function update(UserRequest $request, User $user)
    {
        $user = $this->repository->update($user, $request->allWithHashedPassword());

        flash(trans('admins::user.messages.updated'))->success();

        return redirect()->route('dashboard.users.show', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(User $user)
    {
        if (auth()->user()->is($user)) {
            abort(403, 'cannot be deleted due to that your admin.');
        }

        $this->repository->delete($user);

        flash(trans('admins::user.messages.deleted'))->error();

        return redirect()->route('dashboard.users.index');
    }

    /**
     * @param User $user
     * @return RedirectResponse
     * @throws Exception
     */
    public function block(User $user)
    {
        $this->repository->block($user);

        flash(trans('admins::user.messages.blocked'))->success();

        return redirect()->route('dashboard.users.show', $user);
    }

    /**
     * @param User $user
     * @return RedirectResponse
     * @throws Exception
     */
    public function unblock(User $user)
    {
        $this->repository->unblock($user);

        flash(trans('admins::user.messages.unblocked'))->success();

        return redirect()->route('dashboard.users.show', $user);
    }

    /**
     *  Display a listing of the trashed resource.
     * @param User $user
     * @return Renderable
     */
    public function trashed()
    {
        $users = $this->repository->trashed();
        return view('admins::users.trashed', compact('users'));
    }

    /**
     * force delete the specified resource from storage.
     * @param User $user
     * @return Renderable
     */
    public function forceDelete($id)
    {
        $user = User::withTrashed()->find($id);

        $this->repository->forceDelete($user);

        flash(trans('admins::user.messages.forceDeleted'))->error();

        return redirect()->route('dashboard.users.trashed');
    }

    /**
     * Restore the specified resource from storage.
     * @param User $user
     * @return Renderable
     */
    public function restore($id)
    {
        $user = User::withTrashed()->find($id);

        $this->repository->restore($user);

        flash(trans('admins::user.messages.restored'))->success();

        return redirect()->route('dashboard.users.trashed');
    }
}
