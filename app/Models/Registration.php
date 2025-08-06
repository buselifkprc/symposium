<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'participation_type',
        'membership_type',
        'is_ascs_member',
        'presentation_type',
        'extra_paper_count',
        'note',
    ];

    /**
     * The attributes that should be cast to native types.
     * Bu, 'is_ascs_member' alanından 0/1 yerine true/false almanızı sağlar.
     * @var array<string, string>
     */
    protected $casts = [
        'is_ascs_member' => 'boolean',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function papers()
    {
        return $this->hasMany(Paper::class);
    }
}
