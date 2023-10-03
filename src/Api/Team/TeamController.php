<?php

namespace Api\Team;

use Api\Team\Requests\TeamMemberRequests;
use Api\Team\Resources\TeamMemberResource;
use Api\User\Resources\UserResource;
use Domain\CarePlan\Model\CarePlan;
use Domain\User\Model\User;
use Domain\User\UserType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Support\Controller;
use Support\Resources\CustomMetaCollection;

class TeamController extends Controller
{
    public function index(CarePlan $carePlan): CustomMetaCollection
    {
        return TeamMemberResource::collection($carePlan->team()->paginate());
    }

    public function store(TeamMemberRequests $request, CarePlan $carePlan): void
    {
        $carePlan->team()->sync($request->validated(), false);
    }

    public function destroy(CarePlan $carePlan, User $user): void
    {
        $carePlan->team()->detach($user);
    }
}
