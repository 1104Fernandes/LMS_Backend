<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{

    protected $table = 'Test';
    public $timestamps = FALSE;
    protected $primaryKey = 'test_id';

    protected $fillable = [
        'test_id', 'user_id', 'category_id', 'reached_points','first_test'
    ];
    public function input()
    {
        return $this->hasMany(TestInput::class, 'test_id');
    }
}
