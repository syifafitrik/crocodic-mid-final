<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
        'is_active',
        'created_at',
        'updated_at',
    ];

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)
                ->timezone('Asia/Jakarta')
                ->format('d F Y H:i:s'),
        );
    }

    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)
                ->timezone('Asia/Jakarta')
                ->format('d F Y H:i:s'),
        );
    }
}
