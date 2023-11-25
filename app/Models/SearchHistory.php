<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchHistory extends Model
{
    use HasFactory;

    protected $table = 'search_history'; // Ensure this line is present

    protected $fillable = [
        'full_name',
        'email_address',
        'questions_amount',
        'select_difficulty',
        'select_type',
    ];
}