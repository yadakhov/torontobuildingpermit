<?php

namespace App\Models;

class Permit extends BaseModel
{
    protected $table = 'permits';

    public $timestamps = false;

    public $incrementing = false;

    protected $guarded = [];

    /**
     * Get Full Address
     *
     * @return string
     */
    public function getFullAddress()
    {
        if (empty($this->street_direction)) {
            // No direction
            return sprintf('%s %s %s Toronto ON %s Canada', $this->street_num, $this->street_name, $this->street_type, $this->postal);
        } else {
            // with Direction
            return sprintf('%s %s %s %s Toronto ON %s Canada', $this->street_num, $this->street_name, $this->street_type, $this->street_direction, $this->postal);
        }
    }
}
