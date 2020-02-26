<?php return '<?php

namespace App\\Http\\Requests;

use Illuminate\\Foundation\\Http\\FormRequest;

//use Illuminate\\Support\\Facades\\Route;
//use Illuminate\\Validation\\Rule;

class TestuserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // $current_route = Route::currentRouteName();

        // if ($current_route == \'testuser.update\') {
        //     return $this->user()->can(\'update\', $this->route(\'testuser\'));
        // }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           \'name\' => \'required\',
\'my_date\' => \'nullable|date\',
\'email\' => \'required|email\',
\'email_verified_at\' => \'nullable|date\',
\'password\' => \'required\',
\'attending\' => \'required|boolean\',
\'description\' => \'required\',
\'votes\' => \'required|numeric\',
\'plan_description\' => \'nullable\',
\'remember_token\' => \'nullable\',

        ];
    }
}
';
