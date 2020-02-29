<?php return '<?php

namespace App\\Http\\Requests;

use Illuminate\\Foundation\\Http\\FormRequest;

//use Illuminate\\Support\\Facades\\Route;
//use Illuminate\\Validation\\Rule;

class CredentialRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // $current_route = Route::currentRouteName();

        // if ($current_route == \'credential.update\') {
        //     return $this->user()->can(\'update\', $this->route(\'credential\'));
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
           \'are_you_coming\' => \'required|boolean\',
\'number_of_items\' => \'required|numeric\',
\'start_date\' => \'required|date\',
\'end_date\' => \'required|date\',
\'tagged_at\' => \'required|date\',
\'first_name\' => \'required\',
\'last_name\' => \'required\',
\'address\' => \'required\',
\'city\' => \'nullable\',
\'no_type_here\' => \'nullable\',
\'state\' => \'required\',
\'zip_code\' => \'nullable\',
\'description\' => \'nullable\',
\'phone\' => \'nullable\',
\'user_test_id\' => \'nullable|numeric\',
\'user_bigint\' => \'nullable|numeric\',
\'user_smallint\' => \'nullable|numeric\',
\'user_tinyint\' => \'nullable|numeric\',
\'email\' => \'nullable|email\',
\'company_url\' => \'nullable|url\',

        ];
    }
}
';
