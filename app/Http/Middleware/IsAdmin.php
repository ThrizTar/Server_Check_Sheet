<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use SebastianBergmann\Type\NullType;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // If complete authentication
        if (auth()->check()) {
            $user = auth()->user();
            $isAdmin = Admin::where('username', $user->username)->first();

            // If have admin privilege
            if ($isAdmin && $isAdmin->is_admin == '1' || $user->username == 'domrong.a') {
                session(['is_admin' => true]);
                return $next($request);
            
            // If not have admin privilege
            } else {
                session(['is_admin' => false]);
                return redirect('/user');
            }
        }
    }
}
