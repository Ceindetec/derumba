<?php

namespace App\Http\Middleware;
use Illuminate\Contracts\Auth\Guard;

use Closure;

class Propietario
{
    protected $auth;
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        switch($this->auth->user()->rol){

            case 'SuperAdmin':
                return redirect('superAdmin');
                break;
            case 'Propietario':
                //return redirect('propietario');
                break;
            case 'Administrador':
                return redirect('administrador');
                break;
            default :
                return redirect('login');
        }
        return $next($request);
    }
}
