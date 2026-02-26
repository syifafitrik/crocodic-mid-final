<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterGame extends Model
{
    protected $table      = 'master_game';
    protected $primaryKey = 'id';
    public $incrementing  = true;
    public $timestamps    = true;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'user_id',
        'created_at',
        'updated_at',
    ];
}
