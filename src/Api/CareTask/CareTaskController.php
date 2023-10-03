<?php

namespace Api\CareTask;

use Api\CareTask\Resources\CareTaskResource;
use Domain\CareTask\Model\CareTask;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Support\Controller;
use Support\Resources\CustomMetaCollection;

class CareTaskController extends Controller
{
    public function index(): CustomMetaCollection
    {
        $tasks = QueryBuilder::for(CareTask::class)
            ->allowedIncludes('assignee')
            ->allowedFilters([
                AllowedFilter::exact('status'),
                AllowedFilter::exact('assignee', 'assignee_id'),
            ])
            ->paginate();

        return CareTaskResource::collection($tasks);
    }
}
