<?php

namespace Modules\Settings\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Laraeast\LaravelSettings\Facades\Settings;
use Modules\Settings\Entities\ContactUs;
use Modules\Settings\Entities\Setting;
use Modules\Settings\Transformers\ContactSettingResource;
use Modules\Settings\Transformers\PixelResource;
use Modules\Settings\Transformers\SeoResource;
use Modules\Settings\Transformers\SettingResource;
use Modules\Settings\Transformers\StaticPagesResource;
use App\Traits\ApiTrait;

class SettingController extends Controller
{
    use ApiTrait;

    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $data = new SettingResource(Setting::class);
        return $this->sendResponse($data, 'success');
    }

    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function staticPages(): JsonResponse
    {
        $data = new StaticPagesResource(Setting::class);
        return $this->sendResponse($data, 'success');
    }

    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function seo(): JsonResponse
    {
        $data = new SeoResource(Setting::class);
        return $this->sendResponse($data, 'success');
    }

    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function contacts(): JsonResponse
    {
        $data = new ContactSettingResource(Setting::class);
        return $this->sendResponse($data, 'success');
    }

    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function pixels(): JsonResponse
    {
        $data = new PixelResource(Setting::class);
        return $this->sendResponse($data, 'success');
    }

    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function aboutUs(): JsonResponse
    {
        $data = [
            "title" => Settings::locale(app()->getLocale())->get('about_header'),
            "description" => Settings::locale(app()->getLocale())->get('about_desc'),
            "image" => Settings::instance('about_image')?->getFirstMediaUrl('about_image')
        ];

        return $this->sendResponse($data, 'success');
    }


    /**
     * Display a listing of the resource.
     */
    public function contactUsPost(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable',
            'message' => 'required',
        ], [
            'name.required' => __('frontend::frontend.name_required'),
            'email.required' => __('frontend::frontend.email_required'),
            'email.email' => __('frontend::frontend.email_email'),
            'service.required' => __('frontend::frontend.service_required'),
            // 'phone.required' => __('phone is required'),
            'message.required' => __('frontend::frontend.message_required'),
        ]);

        if ($validator->fails()) {
            $firstError = $validator->errors()->first();
            return $this->sendError($firstError);
        }

        ContactUs::create($request->all());

        return $this->sendSuccess(__('frontend::frontend.contact_success'));
    }



    public function activateModel(Request $request)
    {
        Settings::set($request->model, (bool) $request->status);
        return response()->json([
            'active' => (bool) $request->status,
        ], 200);
    }

}
