<?php

namespace Modules\Settings\Http\Controllers\Dashboard;

use App\DataTables\ContactsDataTable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Mockery\Matcher\Contains;
use Modules\Settings\Entities\ContactUs;
use Yajra\DataTables\Facades\DataTables;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $data = ContactUs::latest()->paginate(10);
        return view('settings::contact-us.index', compact('data'));


        // if ($request->ajax()) {
        //     $data = ContactUs::select('*');
        //     return DataTables::of($data)
        //         ->addIndexColumn()
        //         ->addColumn('action', function ($contact) {

        //             $btn = '<a href=" ' . route('dashboard.contact-us.show', $contact)  . ' "
        //                         class="btn btn-outline-warning waves-effect waves-light btn-sm">
        //                         <i class="fas fa fa-fw fa-eye"></i>
        //                     </a>
        //                     <a href="#contact-' . $contact->id . '-delete-model" class="btn btn-outline-danger waves-effect waves-light btn-sm"
        //                         data-toggle="modal">
        //                         <i class="fas fa-trash-alt fa fa-fw"></i>
        //                     </a>

        //                     <div class="modal fade" id="contact-' . $contact->id . '-delete-model" tabindex="-1" role="dialog"
        //                         aria-labelledby="modal-title-' . $contact->id . '" aria-hidden="true">
        //                         <div class="modal-dialog" role="document">
        //                             <div class="modal-content">
        //                                 <div class="modal-header">
        //                                     <h5 class="modal-title" id="modal-title-' . $contact->id . '"' .
        //                                         __('settings::contactus.dialogs.delete.title') . '</h5>
        //                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        //                                         <span aria-hidden="true">&times;</span>
        //                                     </button>
        //                                 </div>
        //                                 <div class="modal-body">
        //                                 ' . __('settings::contactus.dialogs.delete.info') . '
        //                                 </div>
        //                                 <div class="modal-footer">
        //                                     <form action=" ' . route('dashboard.contact-us.destroy', $contact->id) . ' " method="post">
        //                                     ' . method_field('delete') . csrf_field() . '
        //                                     <button type="button" class="btn btn-secondary" data-dismiss="modal">
        //                                             ' . __('settings::contactus.dialogs.delete.cancel') . '
        //                                         </button>
        //                                         <button type="submit" class="btn btn-danger">
        //                                             ' . __('settings::contactus.dialogs.delete.confirm') . '
        //                                         </button>
        //                                     </form>
        //                                 </div>
        //                             </div>
        //                         </div>
        //                     </div>
        //                     ';

        //             return $btn;
        //         })
        //         ->rawColumns(['action'])
        //         ->make(true);
        // }

        // return view('settings::contact-us.datatables');
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $contact = ContactUs::find($id);
        return view('settings::contact-us.show', compact('contact'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $contact = ContactUs::find($id);
        $contact->delete();
        return redirect()->route('dashboard.contact-us.index')->with('success', trans('settings::contactus.messages.deleted'));
    }
}
