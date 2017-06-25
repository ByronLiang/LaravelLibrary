<?php

namespace App\Http\Middleware;

class BarFilter
{
	public function handle($request, \Closure $next, $age, $gender)
	{
		if ($request->age >= $age && $request->gender == $gender) {
			return $next($request);
		}
	}
}