<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listener extends Model
{
    protected $fillable = [
        'name', 'surname', 'email', 'institution',
        'phone_number', 'degree', 'participation_type'
    ];

    // Degree için
    public function getDegreeAttribute($value)
    {
        $degrees = [
            1 => 'Ph. D.',
            2 => 'Assistant Professor',
            3 => 'Associate Professor',
            4 => 'Professor',
            5 => 'Expert / Student / Other',
        ];
        return $degrees[$value] ?? 'Unknown';
    }

    // Participation için
    public function getParticipationTypeAttribute($value)
    {
        $types = [
            1 => 'Main Conference',
            2 => 'WDIAA – ... workshop session',
            3 => 'Elif',
            4 => 'Murat',
            5 => 'Buse',
        ];
        return $types[$value] ?? 'Unknown';
    }
}
