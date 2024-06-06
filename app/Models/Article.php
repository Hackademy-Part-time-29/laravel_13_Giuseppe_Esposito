<?php

namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    //indichiamo le colonne "fillable" cioè riempibili
    protected $fillable = ['name', 'description', 'cover', 'author_id'];
    
    public function author(){
        
        return $this->belongsTo(User::class);
    }
}
