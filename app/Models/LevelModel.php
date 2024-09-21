<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LevelModel extends Model
{
    use HasFactory;
    protected $table = 'm_level';
    protected $primaryKey = 'level_id';


    // Relasi ke UserModel (hasMany)
    public function users(): HasMany {
        return $this->hasMany(UserModel::class, 'level_id', 'level_id');
    }
}