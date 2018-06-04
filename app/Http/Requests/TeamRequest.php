<?php

namespace App\Http\Requests;

use App\Http\Requests\CustomRequest;

class TeamRequest extends CustomRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }

}
