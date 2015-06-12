<?php

namespace Kicker\Controller;

use Symfony\Component\HttpFoundation\Request;

class ApiController extends Controller
{
    public function saveMatchAction(Request $request)
    {
        $match = $request->get('match');

        $redTeamId = $this->app['repository.team']->getOrCreateTeamId($match['red_goalkeeper'], $match['red_forward']);
        $blueTeamId = $this->app['repository.team']->getOrCreateTeamId($match['blue_goalkeeper'], $match['blue_forward']);

        $this->app['repository.match']->save($redTeamId, $blueTeamId, $match['red_score'], $match['blue_score']);

        return json_encode(['success' => true]);
    }
}