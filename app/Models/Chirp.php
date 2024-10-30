<?php

namespace App\Models;

use App\Events\ChirpCreated; // tambahkan ini
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Chirp extends Model
{
    protected $fillable = [
        'message',
    ];

    // tambahkan ini juga
    protected $dispatchesEvents = [
        'created' => ChirpCreated::class,
    ];

    // dan ini
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
