<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Difficult extends Model
{
    protected $table = 'Difficult';
    public $timestamps = FALSE;
    protected $primaryKey = 'difficult_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'difficult'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class, 'difficult_id');
    }
}
