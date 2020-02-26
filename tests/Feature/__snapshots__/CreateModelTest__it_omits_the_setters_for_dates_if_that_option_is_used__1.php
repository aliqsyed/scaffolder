<?php return '<?php

namespace App;

use Carbon\\Carbon;
use Illuminate\\Database\\Eloquent\\Model;
use Illuminate\\Database\\Eloquent\\SoftDeletes;

class Testuser extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
           \'my_date\' => \'date:m/d/Y\',
   \'email_verified_at\' => \'date:m/d/Y\',

    ];

    /**
     * Get the user associated with this Testuser
     *
     */
    public function user()
    {
        return $this->belongsTo("App\\User");
    }

    
}
';
