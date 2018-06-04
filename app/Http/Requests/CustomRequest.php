<?php namespace App\Http\Requests;

use Hasher;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CustomRequest extends FormRequest
{

    public $validator = null;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validator instance for the request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function getValidatorInstance()
    {

        $validator = parent::getValidatorInstance();
        $this->validator = $validator;

        return $validator;
    }

    /**
     * Set custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {

        $attributes = array_keys($this->rules());

        $translate_attributes = [];
        foreach ($attributes as $key => $attribute) {
            $translate_attributes[$attribute] = trans('attributes.' . $attribute);
        }
        return $translate_attributes;
    }

    protected function getSegmentFromEnd($position_from_end = 1)
    {
        $segments = $this->segments();

        return Hasher::decode($segments[sizeof($segments) - $position_from_end]);
    }

}
