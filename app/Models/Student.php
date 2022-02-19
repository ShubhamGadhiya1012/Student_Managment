<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['id','roll','fname','lname','phone','email'];
    //Fillable - data insert into database
    use HasFactory;
}
