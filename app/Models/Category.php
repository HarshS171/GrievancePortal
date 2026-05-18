<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'officer_name', 'officer_phone'];

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }
}
