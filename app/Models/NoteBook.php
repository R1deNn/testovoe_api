<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class NoteBook extends Model
{
    use HasFactory, Notifiable;

    public $table = 'notebooks';

    protected $fillable = [
        'fio',
        'company',
        'tel',
        'email',
        'bth',
        'photo',
    ];
}
