<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserRights extends Model
{
    protected $table = 'UserRights';
    public $timestamps = FALSE;
    protected $primaryKey = 'user_rights_id';
}
