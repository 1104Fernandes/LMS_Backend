<?php


namespace App\Http\Controllers;


use App\Models\Gender;
use App\Models\Question;

class GenderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function get()
    {
        $gender = Gender::all();
        $res = ["status" => "ok", "data" => $gender];
        return response()->json($res, 200);
    }
}
