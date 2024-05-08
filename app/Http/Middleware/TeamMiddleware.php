<?php

namespace App\Http\Middleware;

use App\Exceptions\MissingTeamException;
use App\Exceptions\TeamDoesNotExistException;
use App\Exceptions\UserDoesNotHaveRoleException;
use App\Models\Team;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeamMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!$request->headers->has('Team')){
            throw new MissingTeamException();
        }

        $team = Team::query()->whereToken($request->headers('Team'))->first();

        if(!$team){
            throw new TeamDoesNotExistException();
        }

        setPermissionsTeamId($team->id);

        if(!auth()->user()->roles()->exists()){
            throw new UserDoesNotHaveRoleException();
        }

        return $next($request);
    }
}
