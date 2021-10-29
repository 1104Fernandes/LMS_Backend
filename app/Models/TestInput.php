<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestInput extends Model
{
    protected $table = 'TestInput';
    public $timestamps = FALSE;
    protected $primaryKey = 'input_id';
    protected $fillable = [
        'input_id', 'test_id', 'question_id', 'answer_id'
    ];
    public function test()
    {
        return $this->belongsTo(Test::class, 'test_id');
    }
    public  function question()
    {
        return $this->hasMany(Question::class,'question_id');
    }
}
