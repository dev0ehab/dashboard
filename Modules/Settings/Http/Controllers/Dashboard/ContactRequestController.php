<?php

namespace Modules\Settings\Http\Controllers\Dashboard;

use App\Imports\ContactsImport;
use Excel;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Frontend\Entities\ContactRequest;

class ContactRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $contacts = ContactRequest::all();
        return view('settings::requests.index', compact('contacts'));
    }


    // public function import(Request $request)
    // {
    //     Excel::import(new ContactsImport, $request->file('file')->store('temp'));
    //     return back();
    // }

}
