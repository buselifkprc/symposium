<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'registration_id', // foreign key
        'paper_title',
        'paper_content',
    ];
    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
