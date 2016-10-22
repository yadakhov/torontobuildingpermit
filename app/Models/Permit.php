<?php

namespace App\Models;

class Permit extends BaseModel
{
    protected $table = 'permits';

    public $timestamps = false;

    public $incrementing = false;

    protected $guarded = [];
}
