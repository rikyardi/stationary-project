<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Req extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'tanggal_permintaan', 'status', 'tanggal_approve', 'approver_id'];

}
