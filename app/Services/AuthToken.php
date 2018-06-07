<?php

namespace App\Services;

use App\Models\Token;
use Illuminate\Support\Facades\Request;

/**
 *
 */
class AuthToken
{

    public function check()
    {
        $request = Request::instance();

        if (!$request->has('project_token') and !$request->get('project_token')) {
            abort(403, 'Você não está autorizado a utilizar está ação.');
        } elseif (!$request->has('client_token') and !$request->get('client_token')) {
            abort(403, 'Você não está autorizado a utilizar está ação.');
        } else {
            $found = Token::where('project_token', $request->get('project_token'))->where('client_token', $request->get('client_token'))->first();
        }
    }
}
