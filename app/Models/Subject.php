<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
     use HasFactory;
    protected $fillable = ['SUBJECT_CODE','SUBJECT_NAME','GROUP_CODE'];
}
