<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Report;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_id',
        'user_id',
        'comment',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    // public function report()
    // {
    //     return $this->belongsTo(Report::class);
    // }
}
