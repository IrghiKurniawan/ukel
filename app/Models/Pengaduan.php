<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pengaduans';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'description',
        'type',
        'province',
        'regency',
        'subdistrict',
        'village',
        'voting',
        'viewers',
        'image',
        'statement',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'voting' => 'array',
        'statement' => 'boolean',
    ];

    /**
     * Get the user that owns the report.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
