<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'Job';
    public $timestamps = FALSE;
    protected $primaryKey = 'job_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_name'
    ];
    public function user()
    {
        $this->hasMany(User::class,'user_id');
    }
}
