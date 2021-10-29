<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $table = 'Gender';
    public $timestamps = FALSE;
    protected $primaryKey = 'gender_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gender_name'
    ];
    public function gender()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
