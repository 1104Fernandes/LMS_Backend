<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Profession extends  Model
{
    protected $table = 'Profession';

    public $timestamps = FALSE;
    protected $primaryKey = 'proffession_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'profession'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
