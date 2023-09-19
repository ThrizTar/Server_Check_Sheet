<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $primaryKey = 'username';
    public $incrementing = false;

    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'department',
        'is_admin',
        'organize',
        'email',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
