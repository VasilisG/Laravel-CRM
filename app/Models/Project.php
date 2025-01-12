<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    const DEFAULT_STATUS_VALUE = 'kick-off';
    const DEFAULT_COST_VALUE = 0;

    protected $attributes = [
        'status'     => self::DEFAULT_STATUS_VALUE,
        'cost'       => self::DEFAULT_COST_VALUE,
        'client_id'  => null
    ];

    protected $fillable = ['title', 'description', 'deadline', 'status', 'cost'];

    public static function searchableFields() {
        return ['title'];
    }

    public function client(): BelongsTo {
        return $this->belongsTo(\App\Models\Client::class);
    }

    public function tasks(): HasMany {
        return $this->hasMany(\App\Models\Task::class);
    }
}
