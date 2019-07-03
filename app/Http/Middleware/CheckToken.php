<?php

namespace App\Http\Middleware;

use App;
use App\Models\Token;
use Closure;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|array  $ips
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (!$request->header('X-Project-Token')) {
            abort(403, 'Não foi possivel efetuar a autenticação!');
        }

        if (!in_url('token') and !in_url('new')) {

            if (!$request->header('X-Client-Token')) {
                abort(403, 'Não foi possivel efetuar a autenticação!');
            }
            // \Config::set('database.default', env('DB_DATABASE'));
            // abort(403, \DB::getDatabaseName());

            $found = Token::where('project_token', $request->header('X-Project-Token'))->where('client_token', $request->header('X-Client-Token'))->first();
            if (!$found) {
                abort(403, 'Você não está autorizado a utilizar está ação!');
            }
        }

        return $next($request);
    }
}
