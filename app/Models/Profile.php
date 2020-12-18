<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    use HasFactory;

    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class);
    }
//return the path of profile image
    public function profileImage()
    {
        $imagePath = ($this->image) ? $this->image : 'profile/null.png';

        return '/storage/' . $imagePath;
    }
//the relations

    public function followers()
    {
        return $this->belongsToMany(User::class);
    }
}
