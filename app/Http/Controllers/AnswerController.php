<?php


namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
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
        $Answer = Answer::all();
        $res = ["status" => "ok", "data" => $Answer];
        return response()->json($res);
    }

    public function create(Request $request)
    {
        $Answer =  new Answer();
        $Answer->description = $request->description;
        $Answer->question_id = $request->question_id;
        $Answer->save();
        $res = ["status" => "ok", "data" => $Answer];
        return response()->json($res);
    }

    public function getOne($id)
    {
        $Answer = Answer::find($id);
        $res = ["status" => "ok", "data" => $Answer];
        return response()->json($res);
    }

    public function update(Request $request, $id)
    {
        $Answer = Answer::find($id);

        $Answer->description = $request->input('description');
        $Answer->question_id = $request->input("question_id");

        $Answer->save();
        $res = ["status" => "ok", "data" => $Answer];
        return response()->json($res);
    }

    public function delete($id)
    {
        $Answer = Answer::find($id);
        $Answer->delete();
        $res = ["status" => "ok", "data" => $Answer];
        return response()->json($res);
    }
}
