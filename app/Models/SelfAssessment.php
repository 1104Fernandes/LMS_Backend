<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class selfAssessment extends Model
{
    protected $table = 'self_assessment';
    public $timestamps = FALSE;
    protected $primaryKey = 'assessment_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'category_id',"value"
    ];
}
