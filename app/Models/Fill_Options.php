<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fill_Options extends Model
{
    use HasFactory;
    protected $primaryKey = 'input_option';
    public $incrementing = false;

    protected $fillable = [
        'input_option',
        'form_fill_input',
        'option_detail'
    ];
}
