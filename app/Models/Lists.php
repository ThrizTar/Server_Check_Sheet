<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
    use HasFactory;
    protected $primaryKey = 'list_detail';
    public $incrementing = false;

    protected $fillable = [
        'checklist_organize',
        'list_detail'
    ];
}
