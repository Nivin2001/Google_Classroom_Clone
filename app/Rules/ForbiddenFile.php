<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ForbiddenFile implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

     protected $types;
     // الملفات الممنوعة
     public function __construct(... $types)
     {
        $this->types=$types;

     }
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        $type=$value->getMimeType();

        if(in_array($type,$this->types)){
            $fail('File type not allowed');
        }
        // dd($type,$value->getClientOriginalExtension());
    }
}
