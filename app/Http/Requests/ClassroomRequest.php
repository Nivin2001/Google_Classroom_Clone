<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;


class ClassroomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
            'name'=>['required','string','max:255',function($attribute,$value,$fail){
                //coustom validation rule
                if($value=='admin'){
                    return $fail('this:attribute value is forbidden');
                    // اذا صار عندي مشكلة بستدعيها
                    // م صار م بستدعيها

                }

            }],

                'code'=>'string',
                'name'=>'required|max:255',
                'section'=>'required|string|max:255',
                'subject'=>'nullable|string|max:255',
                'room'=>'nullable|string|max:255',
                'cover_image'=>[
                    'nullable',
                    'image',
                    'max:1024',
                    Rule::dimensions([
                      'min_width'=> 600,
                      'min_height'=> 300,
                    ]),

                ],

        ];
    }
    public function messages(): array
    {
        return [
            'required'=>':attribute Important !',
            'name.required'=>'The name is required ',
            'cover_image.max'=>'Image size is great than 1M',
         ];

    }
}
