<?php return '<?php

namespace App;

use Carbon\\Carbon;
use Illuminate\\Database\\Eloquent\\Model;
use Illuminate\\Database\\Eloquent\\SoftDeletes;

class Credential extends Model
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
           \'start_date\' => \'date:m/d/Y\',
   \'end_date\' => \'date:m/d/Y\',
   \'tagged_at\' => \'date:m/d/Y\',

    ];

    /**
     * Get the user associated with this Credential
     *
     */
    public function user()
    {
        return $this->belongsTo("App\\User");
    }

       /**
     * Convert start_date to mm/dd/yyyy format for display
     *
     */
    public function setStartDateAttribute($value)
    {
        if (is_null($value)) {
            $this->attributes[\'start_date\'] = null;
        } else {
            $this->attributes[\'start_date\'] = Carbon::createFromFormat(\'m/d/Y\', $value)->format(\'Y-m-d\');
        }
    }

   /**
     * Convert end_date to mm/dd/yyyy format for display
     *
     */
    public function setEndDateAttribute($value)
    {
        if (is_null($value)) {
            $this->attributes[\'end_date\'] = null;
        } else {
            $this->attributes[\'end_date\'] = Carbon::createFromFormat(\'m/d/Y\', $value)->format(\'Y-m-d\');
        }
    }

   /**
     * Convert tagged_at to mm/dd/yyyy format for display
     *
     */
    public function setTaggedAtAttribute($value)
    {
        if (is_null($value)) {
            $this->attributes[\'tagged_at\'] = null;
        } else {
            $this->attributes[\'tagged_at\'] = Carbon::createFromFormat(\'m/d/Y\', $value)->format(\'Y-m-d\');
        }
    }


}
';
