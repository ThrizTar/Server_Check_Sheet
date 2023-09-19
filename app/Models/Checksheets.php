<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checksheets extends Model
{
    use HasFactory;
    protected $primaryKey = 'checksheet_name';
    public $incrementing = false;

    protected $fillable = [
        'checksheet_name',
        'organize',
    ];

    public function checkforms()
    {
        return $this->hasMany(Checkforms::class);
    }
}
