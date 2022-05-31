<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserScore extends Model
{
    use HasFactory;

    protected $table = "user_scores";
    protected $fillable  = ["user_id", "content_id", "score"];

    public function getScore(){
        return $this->sum("score")->where("user_id", Auth::id());
    }
}
