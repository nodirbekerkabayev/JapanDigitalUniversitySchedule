<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /** @use HasFactory<\Database\Factories\GroupFactory> */
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'group_members', 'group_id', 'user_id');

    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'group_subjects', 'group_id', 'subject_id');
    }
}
