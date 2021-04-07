<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TransactionModel extends Model
{
    use HasFactory;
    protected $table = 'transaction';
    protected $fillable = [
        'import_id',
        'date',
        'content',
        'amount',
        'type'
    ];

    public static function getTransactionByUser(){
        return TransactionModel::where('import_id', Auth::user()->id);
    }
}
