<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $fillable = ['user_id', 'action', 'target', 'description'];

    public function user()
    {
        return $table->belongsTo(User::class);
    }
}