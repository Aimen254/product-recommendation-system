<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyDomain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $project =  \App\Models\Project::where('uuid', $request->uuid)->firstOrFail();
        if($project->account->settings &&
            $project->account->settings->custom_domain == request()->root() &&
            $project->account->settings->status == 'active')
        return $next($request);
        else
        abort(404);
    }
}
