<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(mixed $validated)
 */
class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
