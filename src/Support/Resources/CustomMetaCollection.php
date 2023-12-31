<?php

namespace Support\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CustomMetaCollection extends AnonymousResourceCollection
{
    protected function preparePaginatedResponse($request): JsonResponse
    {
        if ($this->preserveAllQueryParameters) {
            $this->resource->appends($request->query());
        }
        elseif (! is_null($this->queryParameters)) {
            $this->resource->appends($this->queryParameters);
        }

        return (new CustomMetaResponse($this))->toResponse($request);
    }
}
