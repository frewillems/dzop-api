<?php

namespace Api\CareTask;

use Api\CareTask\Resources\CareTaskResource;
use Api\CareTask\Validations\CareTaskRequest;
use Domain\CareGoal\Model\CareGoal;
use Domain\CareTask\Model\CareTask;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Support\Controller;
use Support\Resources\CustomMetaCollection;

class NestedCareTaskController extends Controller
{
    public function index(CareGoal $careGoal): CustomMetaCollection
    {
        $tasks = QueryBuilder::for($careGoal->tasks())
            ->allowedIncludes('assignee')
            ->allowedFilters([
                AllowedFilter::exact('status'),
                AllowedFilter::exact('assignee', 'assignee_id'),
            ])
            ->paginate();

        return CareTaskResource::collection($tasks);
    }

    public function show(CareTask $careTask): CareTaskResource
    {
        $careTask->load('assignee');
        return new CareTaskResource($careTask);
    }

    public function store(CareTaskRequest $request, CareGoal $careGoal): CareTaskResource
    {
        $task = $careGoal->tasks()->create($request->validated());
        return new CareTaskResource($task);
    }
}
