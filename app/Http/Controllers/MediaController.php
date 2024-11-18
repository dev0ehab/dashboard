<?php

namespace App\Http\Controllers;


use App\Traits\ApiTrait;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;

class MediaController extends Controller
{
    use ApiTrait;

    /**
     * @param $media
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($media)
    {
        $modelClass = Config::get(
            'media-library.media_model',
            \Spatie\MediaLibrary\MediaCollections\Models\Media::class
        );

        $media = $modelClass::findOrFail($media);

        $media->delete();

        return $this->sendSuccess(__('messages.success'));
    }
}
