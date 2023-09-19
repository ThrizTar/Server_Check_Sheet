<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Check_Input extends Model
{
    use HasFactory;
    protected $primaryKey = 'check_id';

    protected $fillable = [
        'check_id',
        'username',
        'list_detail',
        'status',
        'comment'
    ];
    
}
