<?php

namespace Api\Auth;

use Api\Auth\Resources\AuthUserResource;
use Domain\User\UserType;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Support\Controller;

class AuthController extends Controller
{
    private AuthManager $authManager;

    public function __construct(AuthManager $authManager)
    {
        $this->authManager = $authManager;
    }

    public function index(): AuthUserResource
    {
        $user = auth()->user();

        if ($user->type === UserType::Patient->value) {
            $user->load('carePlan');
        }

        return new AuthUserResource($user);
    }

    public function store(Request $request): array
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!$this->authManager->attempt($validated)) {
            abort(401);
        }

        $user = $this->authManager->user();

        return [
            'data' => [
                'token' => $user->createToken('web')->plainTextToken,
            ],
        ];
    }

    public function destroy()
    {
        //
    }
}
