<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    protected $table = 'Classification';
    public $timestamps = FALSE;
    protected $primaryKey = 'ClassificationId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id','difficult_id','userId'
    ];
    public function User()
    {
        $this->belongsTo(User::class,'user_id');
    }
    public function difficult()
    {
        $this->hasOne(Difficult::class,'difficult_id');
    }
    public function category()
    {
        $this->hasOne(Category::class,'category_id');
    }
}
