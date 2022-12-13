<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Gallery;

class Comment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'gallery_id',
        'comment',
    ];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class, 'gallery_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
