<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yadakhov\InsertOnDuplicateKey;

class BaseModel extends Model
{
    use InsertOnDuplicateKey;
}
