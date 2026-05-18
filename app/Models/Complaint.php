<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'image',
        'status',
        'admin_remark',
        'block',
        'floor',
        'room_number',
        'area_location',
        'contact_number',
        'preferred_time_slot',
        'availability_date',
        'is_urgent',
        'is_anonymous',
        'is_escalated'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class);
    }
}
