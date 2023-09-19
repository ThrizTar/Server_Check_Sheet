<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkforms extends Model
{
    use HasFactory;
    protected $primaryKey = 'checkform_organize';
    public $incrementing = false;

    protected $fillable = [
        'checkform_organize',
        'checkform_name',
        'checksheet_name',
        'form_type'
    ];

    public function checksheet()
    {
        return $this->belongsTo(Checksheet::class);
    }

    public function checklists()
    {
        return $this->hasMany(Checklist::class);
    }
}
