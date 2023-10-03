<?php

namespace Support\Resources;

use Illuminate\Support\Arr;
use Support\Model;

/**
 * @mixin Model
 */
class JsonResource extends \Illuminate\Http\Resources\Json\JsonResource
{
    protected string $translationKey = '';

    public static function collection($resource)
    {
        return tap(new CustomMetaCollection($resource, static::class), function ($collection) {
            if (property_exists(static::class, 'preserveKeys')) {
                $collection->preserveKeys = (new static([]))->preserveKeys === true;
            }
        });
    }

    public function with($request): array
    {
        if (!property_exists($this->resource, 'hasModelStates')) {
            return [];
        }

        if ($this->wasRecentlyCreated) {
            $notification = $this->getNotification('created');
        }
        else if ($this->wasRecentlyUpdated) {
            $notification = $this->getNotification('updated');
        }
        else if ($this->wasRecentlyDeleted) {
            $notification = $this->getNotification('deleted');
        }

        if (!isset($notification)) {
            return [];
        }

        return [
            'meta' => [
                'notification' => $notification
            ]
        ];
    }

    private function getNotification(string $key): array
    {
        $resource = Arr::except($this->resource->toArray(), ['permissions', 'roles']);
        $resource = Arr::dot($resource);

        return [
            'title' => trans("{$this->translationKey}.notifications.{$key}.title", $resource),
            'message' => trans("{$this->translationKey}.notifications.{$key}.message", $resource)
        ];
    }
}
