<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checklists extends Model
{
    use HasFactory;
    protected $primaryKey = 'checklist_organize';
    public $incrementing = false;

    protected $fillable = [
        'checklist_name',
        'checkform_organize',
        'checklist_organize'
    ];

    // Define relation between lists and checklists
    public function lists()
    {
        return $this->hasMany(Lists::class, 'checklist_organize', 'checklist_organize');
    }

    public function checkform()
    {
        return $this->belongsTo(Checkform::class);
    }
}
