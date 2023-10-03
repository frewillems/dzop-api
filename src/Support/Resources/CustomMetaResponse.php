<?php

namespace Support\Resources;

use Illuminate\Http\Resources\Json\PaginatedResourceResponse;

class CustomMetaResponse extends PaginatedResourceResponse
{
    public function meta($paginated): array
    {
        return [
            'pagination' => [
                'current' => $paginated['current_page'],
                'total' => $paginated['total'],
                'size' => $paginated['per_page']
            ]
        ];
    }
}
