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
        
    ];

    /**
     * Get the user associated with this Testuser
     *
     */
    public function user()
    {
        return $this->belongsTo("App\\User");
    }

       /**
     * Convert my_date to mm/dd/yyyy format for display
     *
     */
    public function setMyDateAttribute($value)
    {
        if (is_null($value)) {
            $this->attributes[\'my_date\'] = null;
        } else {
            $this->attributes[\'my_date\'] = Carbon::createFromFormat(\'m/d/Y\', $value)->format(\'Y-m-d\');
        }
    }

   /**
     * Convert email_verified_at to mm/dd/yyyy format for display
     *
     */
    public function setEmailVerifiedAtAttribute($value)
    {
        if (is_null($value)) {
            $this->attributes[\'email_verified_at\'] = null;
        } else {
            $this->attributes[\'email_verified_at\'] = Carbon::createFromFormat(\'m/d/Y\', $value)->format(\'Y-m-d\');
        }
    }


}
';
