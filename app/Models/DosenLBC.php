<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenLBC extends Model
{
    use HasFactory;

    protected $table = 'dosen_lb';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
    ];

    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}

