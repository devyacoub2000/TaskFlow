<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Team;
use App\Models\User;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function team()
    {
        return $this->belongsTo(Team::class)->withDefault();
    }

    // الشخص الذي أنشأ المهمة
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    // الشخص المسؤول عن تنفيذ المهمة
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to')->withDefault();
    }
}
