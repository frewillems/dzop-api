<?php

namespace Api\CareGoal;

use Api\CareGoal\Requests\CareGoalRequest;
use Api\CareGoal\Resources\CareGoalResource;
use Domain\CareGoal\Model\CareGoal;
use Domain\CarePlan\Model\CarePlan;
use Spatie\QueryBuilder\QueryBuilder;
use Support\Controller;
use Support\Resources\CustomMetaCollection;

class NestedCareGoalController extends Controller
{
    public function index(CarePlan $carePlan): CustomMetaCollection
    {
        $goals = QueryBuilder::for($carePlan->careGoals())
            ->paginate();

        return CareGoalResource::collection($goals);
    }

    public function store(CareGoalRequest $request, CarePlan $carePlan): CareGoalResource
    {
        $goal = $carePlan->careGoals()->create($request->validated());
        return new CareGoalResource($goal);
    }
}
