<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    use HasFactory;

	protected $table = 'user_meta';

    protected $primaryKey = 'user_id';
	public $incrementing = false;

}
