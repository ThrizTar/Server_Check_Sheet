<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fill_Lists extends Model
{
    use HasFactory;
    protected $primaryKey = 'form_fill_input';
    public $incrementing = false;

    protected $fillable = [
        'form_fill_input',
        'input_title',
        'checkform_organize',
        'input_type'
    ];
    
}
