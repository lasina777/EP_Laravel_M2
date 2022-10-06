<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'full_description',
        'short_description',
        'tag',
        'photo',
        'user_id'

    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
