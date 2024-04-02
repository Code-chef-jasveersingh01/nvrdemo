<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nvr extends Model
{
    use HasFactory;

    protected $table = 'nvr_details';


    protected $fillable = ['username', 'password', 'ip_address', 'csrf_token', 'cookie'];


    public $timestamps = true;
}
