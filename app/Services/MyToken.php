<?php

namespace App\Services;

use Dirape\Token\Token;

class MyToken extends Token
{

    public function __construct($model)
    {
        $model = app()->make($model);
        $this->model = $model;
    }

    /**
     * Create a new Unique Token.
     *
     * @return string
     */
    public function client($project_token = null, $size = 25, $special = false)
    {

        $project_token = !$project_token ? env('PROJECT_TOKEN') : $project_token;

        $this->SpecialCharacter = $special;
        do {

            $code = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $code .= "0123456789";

            $tokenClient = $this->Generate($code, $size);
            $t = $this->model->where('project_token', $project_token)->where('client_token', $tokenClient)->first();

        } while ($t);

        return $tokenClient;
    }

    /**
     * Create a new Unique Token.
     *
     * @return string
     */
    public function Unique($table, $col, $size, $special = false)
    {
        $this->SpecialCharacter = $special;
        do {

            $code = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            // $code .= "abcdefghijklmnopqrstuvwxyz";
            $code .= "0123456789";
            $token = $this->Generate($code, $size);
            $t = $this->model->where($col, $token)->first();

        } while ($t);

        return $token;
    }

    /**
     * Create a new Unique Integer Token.
     *
     * @return integer
     */
    public function UniqueNumber($table, $col, $size, $special = false)
    {
        $this->SpecialCharacter = $special;
        do {
            $code = "0123456789";
            $token = $this->Generate($code, $size);
            $t = $this->model->where($col, $token)->first();

        } while ($t);
        return $token;
    }

    /**
     * Generate The Token.
     *
     * @return string
     */
    protected function Generate($code, $size)
    {
        if ($this->SpecialCharacter) {
            $code .= '!@#$%^&*()';
        }
        $token = '';
        $max = strlen($code);
        for ($i = 0; $i < $size; $i++) {
            $token .= $code[random_int(0, $max - 1)];
        }
        return $token;
    }
}
