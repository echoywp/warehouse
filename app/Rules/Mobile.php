<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Mobile implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->value = $value;
        $phoneHead = array("128", "134", "135", "136", "137", "138", "139", "147",
            "150", "151", "152", "157", "158", "159", "182", "183", "184", "187", "188",
            "130", "131", "132", "145", "155", "156", "173", "175", "176", "185", "186",
            "133", "153", "180", "181", "189", "170", "171", "177", "178", '199');

        if(strlen($value) == 11 && is_numeric($value)) {
            $head = substr($value,0,3);
            foreach($phoneHead as $getHead) {
                if($getHead == $head) {
                    return true;
               }
            }
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '请输入正确的电话号码';
    }
}
