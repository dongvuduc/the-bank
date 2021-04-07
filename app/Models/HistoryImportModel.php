<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryImportModel extends Model
{
    use HasFactory;
    protected $table = 'history_import';
    protected $fillable = ['user_import'];

}
