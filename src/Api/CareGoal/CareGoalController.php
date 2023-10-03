<?php

namespace Api\CareGoal;

use Api\CareGoal\Requests\CareGoalRequest;
use Api\CareGoal\Resources\CareGoalResource;
use Domain\CareGoal\Model\CareGoal;
use Domain\CarePlan\Model\CarePlan;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Support\Controller;
use Support\Resources\CustomMetaCollection;

class CareGoalController extends Controller
{
    public function index(CarePlan $carePlan): CustomMetaCollection
    {
        $goals = QueryBuilder::for(CareGoal::class)
            ->allowedFilters([
                AllowedFilter::exact('careplan', 'care_plan_id'),
            ])
            ->paginate();

        return CareGoalResource::collection($goals);
    }

    public function store(CareGoalRequest $request, CarePlan $carePlan): CareGoalResource
    {
        $goal = $carePlan->careGoals()->create($request->validated());
        return new CareGoalResource($goal);
    }
}
