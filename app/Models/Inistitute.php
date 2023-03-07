<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inistitute extends Model
{
    use HasFactory;
    protected $fillable = ['MADRASAH_NAME','MAD_EIIN','CENTER_CODE','CENTER_EIIN','SESSION','GROUP_CODE','GROUP_NAME','DIVISION','DISTRICT','THANA','PHONE','TOTAL_STUDENTS'];
}
