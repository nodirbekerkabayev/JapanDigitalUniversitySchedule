<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    /** @use HasFactory<\Database\Factories\SubjectFactory> */
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'subject_teachers', 'subject_id', 'user_id');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_subjects', 'subject_id', 'group_id');
    }
}
