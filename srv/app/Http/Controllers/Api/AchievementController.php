<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AchievementService;

class AchievementsController extends Controller
{
    protected AchievementService $achievementService;

    public function __construct(AchievementService $achievementService)
    {
        $this->achievementService = $achievementService;
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $this->achievementService->checkAndGrant($user);

        return response()->json(
            $this->achievementService->getAchievementsForUser($user)
        );
    }
}
