<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * Автоматический массив артрибутов
     *
     * @var string[]
     */
    protected $guarded = ['id'];
}
