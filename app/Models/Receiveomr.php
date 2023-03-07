<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receiveomr extends Model
{
    use HasFactory;
     protected $fillable = ['CENTER_CODE','CENTER_EIIN','DISTRICT','THANA','PHONE','SUBJECT_CODE','BIMA_NO','ENTRY_DATE','BIMA_DATE','ENTRY_OMR','REST_OMR','INSERTED_BY','UPDATED_BY','MADRASAH_NAME'];
}


 