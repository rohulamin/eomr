<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eff extends Model
{
     use HasFactory;
    protected $fillable = ['REGISTRATION_NO', 'STUDENT_NAME', 'FATHERS_NAME', 'MOTHERS_NAME', 'ADMISSION_SESSION','STUDENT_GROUP', 'SUBJECT_CODE', 'STUDENT_TYPE', 'MADRASAH_EIIN'];
}
