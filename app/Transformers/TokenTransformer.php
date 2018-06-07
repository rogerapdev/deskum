<?php

namespace App\Transformers;

use App\Models\Token;

class TokenTransformer extends Transformer
{
    public function transform(Token $token)
    {
        return [
            'project_token' => $token->project_token,
            'client_token' => $token->client_token,
            'email' => $token->email,
        ];
    }

}
