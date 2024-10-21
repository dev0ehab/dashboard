<?php

namespace Modules\Settings\Http\Controllers\Dashboard;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\Settings\Entities\MediaRegister;

class MediaRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data = MediaRegister::paginate(10);
        return view('settings::media-registers.index', compact('data'));
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $register = MediaRegister::find($id);
        return view('settings::media-registers.show', compact('register'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $register = MediaRegister::find($id);
        $register->delete();
        return redirect()->route('dashboard.media-registers.index')->with('success', trans('Media Register deleted successfully'));
    }
}

