<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fill_Input extends Model
{
    use HasFactory;
    protected $primaryKey = 'fill_id';
    protected $fillable = [
        'username',
        'form_fill_input',
        'input'
    ];
}
