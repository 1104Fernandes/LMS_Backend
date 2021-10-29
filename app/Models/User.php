<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable, HasFactory;

    protected $table = 'User';
    public $timestamps = FALSE;
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'nickname', 'gender_id', 'age', 'assessment_id', 'profession_id','job_id','e_mail'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
   /* public function self_assessment()
    {
        return $this->hasMany(selfAssessment::class, 'assessment_id');
    }*/
    public function gender()
    {
        return $this->hasOne(Gender::class, 'gender_id');
    }

    public function user_right()
    {
        return $this->hasOne(UserRights::class, 'user_rightd_id');
    }
    public function classification()
    {
        return $this->hasMany(Classification::class,'userId');
    }
    public function selfAssessment()
    {
        return $this->hasMany(selfAssessment::class,'user_id');
    }
    public function job()
    {
        return $this->belongsTo(Job::class,'job_id');
    }

}
