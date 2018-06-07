<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
// use App\Services\AuthToken;
use App\Services\MyToken;
use App\Transformers\TokenTransformer;
use Illuminate\Http\Request;

class TokenController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function newToken(Request $request)
    {

        // (new AuthToken)->check();

        if (!$request->get('email')) {
            abort(422, 'Não é possivel gerar token com os dados informados!');
        }

        $model = new \App\Models\Token();

        $found = $model->where('project_token', $request->header('X-Project-Token'))->where('email', $request->get('email'))->first();
        if (!$found) {

            $token = new MyToken('App\Models\Token');
            $data = [
                'project_token' => $request->get('project_token'),
                'client_token' => $token->client($request->get('project_token'), 25),
                'email' => $request->get('email'),
            ];
            $instance = $model->create($data);

            $result = (new TokenTransformer)->transform($instance);
            return response()->json($result);

        } else {
            abort(422, 'Não é possivel gerar mais de um token para o mesmo cliente no projeto indicado.');
            // return response()->json(['error' => 'Não é possivel gerar mais de um token para o mesmo cliente no projeto indicado'], 422);
        }
    }
}
