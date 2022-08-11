<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comp extends Model
{
    use HasFactory;
    protected $table ='comps';
    protected $fillable = [
        'name',
        'email',
        'website',
        'image'
    ];
}
