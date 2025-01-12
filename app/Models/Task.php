<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    const DEFAULT_STATUS_VALUE = 'kick-off';
    const DEFAULT_COST_VALUE = 0;

    protected $attributes = [
        'status'      => self::DEFAULT_STATUS_VALUE,
        'cost'        => self::DEFAULT_COST_VALUE,
        'project_id'  => null
    ];

    protected $fillable = ['title', 'description', 'deadline', 'status', 'cost'];

    public static function searchableFields(){
        return ['title'];
    }

    public function project(): BelongsTo {
        return $this->belongsTo(\App\Models\Task::class);
    }
}
