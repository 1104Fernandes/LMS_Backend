<?php


namespace App\Http\Controllers;

use App\Models\Difficult;
use Illuminate\Http\Request;
use SebastianBergmann\Diff\Diff;

class DifficultController extends Controller
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

    public function index()
    {
        $Difficult = Difficult::all();
        return response()->json($Difficult);
    }

    public function show($id)
    {
        $Difficult = Difficult::find($id);
        $res = ["status" => "ok", "data" => $Difficult];
        return response()->json($res);
    }
    public function getQuestions($id)
    {
        $question  = Difficult::find($id)->questions;
        $res = ["status" => "ok", "data" => $question];
        return response()->json($res);
    }
}
