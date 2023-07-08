<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['naslov', 'opis', 'kontakt', 'cijena', 'slika', 'category_id', 'user_id'];

    public function category() {
        return $this->hasOne(PostCategory::class, 'id', 'category_id');
    }

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
