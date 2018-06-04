<?php
namespace App\Helpers;

class Dependency
{
    public static function optionsSelect($model, $value = 'name', $key = 'id', $order = 'name')
    {

        $instance = app()->make($model);
        return ['0' => '---'] + $instance->orderBy($order)->pluck($value, $key)->all();

    }

    public static function optionsRepository($repository, $method = 'optionsSelect', $parameters = [])
    {

        $instance = app()->make($repository);
        if (is_callable([$instance, $method])) {
            // return ['0' => '---'] + $instance->{$method}($parameters);
            return ['0' => '---'] + call_user_func_array(array($instance, $method), $parameters);
        } else {
            return ['0' => '---'];
        }

    }

}
