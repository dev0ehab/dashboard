<?php


namespace App\Traits;

use App\Http\Resources\MediaResource;
use Illuminate\Support\Arr;
trait MediaTrait
{
    /**
     * Assign all uploaded temporary files to the model.
     *
     * @param  string|array|null  $tokens
     * @param  string|null  $collection
     * @return void
     */
    public function addAllMediaFromTokens($tokens = null, $collection = null)
    {
        $tokens = Arr::wrap($tokens);

        if (count($tokens) == 0) {
            $tokens = Arr::wrap(request('media'));
        }

        $collection = $collection ?: 'default';

        if ($collectionSizeLimit = optional($this->getMediaCollection($collection))->collectionSizeLimit) {
            $collectionMedia = $this->refresh()->getMedia($collection);

            if ($collectionMedia->count() > $collectionSizeLimit) {
                $this->clearMediaCollectionExcept(
                    $collection,
                    $collectionMedia
                        ->reverse()
                        ->take($collectionSizeLimit)
                );
            }
        }
    }

    /**
     * Get all the model media of the given collection using "MediaResource".
     *
     * @param  string  $collection
     * @return \Illuminate\Support\Collection
     */
    public function getMediaResource($collection = 'default')
    {
        return collect(
            MediaResource::collection(
                $this->getMedia($collection)
            )->jsonSerialize()
        );
    }
}
