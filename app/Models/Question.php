<?php


namespace App\Models;


class Question extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'Question';

    public $timestamps = FALSE;
    protected $primaryKey = 'question_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'category_id', 'difficult_id', 'right_answer'
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class, 'question_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function difficult()
    {
        return $this->belongsTo(Difficult::class, 'difficult_id');
    }

    public function right_answer()
    {
        return $this->belongsTo(Answer::class, 'answer_id');
    }
    public function test_input()
    {
        return $this->belongsTo(TestInput::class, 'question_id');
    }
}
