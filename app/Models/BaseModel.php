<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public function deleteSafe(){
        $this->is_deleted = 1;
        $this->save();
    }
}
