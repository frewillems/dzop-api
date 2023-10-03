<?php

namespace Api\CarePlan;

use Api\CarePlan\Resources\CarePlanResource;
use Domain\CarePlan\CarePlanStatus;
use Domain\CarePlan\Model\CarePlan;
use Domain\User\Model\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Support\Controller;
use Support\Resources\CustomMetaCollection;
use Support\Resources\JsonResource;

class CarePlanController extends Controller
{
    public function index(): CustomMetaCollection
    {
        $plans = QueryBuilder::for(CarePlan::class)
            ->with('user')
            ->allowedIncludes('team')
            ->allowedFilters([
                AllowedFilter::exact('status'),
            ])
            ->paginate();

        return CarePlanResource::collection($plans);
    }

    public function show(CarePlan $carePlan): CarePlanResource
    {
        $carePlan->load('user', 'team');
        return new CarePlanResource($carePlan);
    }

    public function store(Request $request, User $user): CarePlanResource
    {
        if ($user->carePlan()->exists()) {
            abort(400, sprintf('User already has a care plan: %s', $user->carePlan()->first()->id));
        }

        $plan = $user->carePlan()->create([
            'status' => CarePlanStatus::Concept,
        ]);

        $plan->team()->attach($user);

        return new CarePlanResource($plan);
    }
}
