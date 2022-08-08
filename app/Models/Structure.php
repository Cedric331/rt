<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'parent_id',
        'childrens'
    ];

    public function responses (): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ResponseType::class, 'structure_id');
    }
}
