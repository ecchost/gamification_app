<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserScore extends Model
{
    use HasFactory;

    protected $table = "user_scores";
    protected $fillable  = ["user_id", "content_id", "score"];

    public static function getScore(){
        $score =  UserScore::where("user_id", Auth::id())->sum("score");
        return $score;
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
