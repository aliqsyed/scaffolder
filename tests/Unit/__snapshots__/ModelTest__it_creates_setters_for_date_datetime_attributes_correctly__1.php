<?php return '   /**
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

';
