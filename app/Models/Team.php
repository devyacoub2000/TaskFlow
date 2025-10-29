<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Task;
use App\Models\Image;

class Team extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable')->withDefault([
            'path' => 'images/default.jpg'
        ])->where('type', 'main');
    }
    public function getImgPathAttribute()
    {

        $src = 'https://via.placeholder.com/100x80';
        if ($this->image) {
            $src = asset('images/' . $this->image->path);
        }

        return $src;
    }
}
