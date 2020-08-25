<?php

namespace App\Http\Middleware;

use App\Models\Student;
use Closure;

class StudentToken
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->header('Authorization')) {
            $student = Student::where('api_token', $request->header('Authorization'))->first();
            if(isset($student)){
                $request->user = $student;
                return $next($request);
            }
            else {
                return response()->json([
                    'message' => 'Not a valid API request.',
                ]);
            }
        } else {
            return response()->json([
                'message' => 'Not a valid API request.',
            ]);
        }
    }
}
