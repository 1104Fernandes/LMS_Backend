<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    /**
     * QuestionController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function get()
    {

        $questions = Question::all();
        $res = ["status" => "ok", "data" => $questions];
        return response()->json($res, 200);
    }

    public function create(Request $request)
    {
        $question = new Question;
        if (isset($request->description) && isset($request->category_id) && isset($request->difficult_id)) {
            $question->description = $request->description;
            $question->category_id = $request->category_id;
            $question->difficult_id = $request->difficult_id;

            $question->save();
            $res = ["status" => "ok", "data" => $question];
            return response()->json($res, 200);
        } else {
            return response()->json("", 400);
        }
    }

    public function getOne($id)
    {
        $question = question::find($id);
        $res = ["status" => "ok", "data" => $question];
        return response()->json($res, 200);
    }

    public function update(Request $request, $id)
    {
        $question = question::find($id);

        $question->description = $request->input('description');
        $question->category_id = $request->input('category_id');
        $question->difficult_id = $request->input('difficult_id');
        $question->save();
        $res = ["status" => "ok", "data" => $question];
        return response()->json($res);
    }

    public function delete($id)
    {
        $question = question::find($id);
        $question->delete();
        $res = ["status" => "ok", "data" => $question];
        return response()->json($res);
    }
    public function getCategory($id)
    {
        $cat_id = $id;

        $question = question::where('category_id', '=', $id)->get();
        $res = ["status" => "ok", "data" => $question];
        return response()->json($res);
    }
    public function getQuiz($id)
    {
        $question = question::where('difficult_id', '=', $id)->inRandomOrder()->limit(2)->get();
        $res = ["status" => "ok", "data" => $question];
        return response()->json($res, 200);
    }
    public function getAnswer($id)
    {
        $answer = question::find($id)->answers;
        $res = ["status" => "ok", "data" => $answer];
        return response()->json($res);
    }
    public function getAnswers()
    {
        $questions = Question::with('answers')->get();
        $res = ["status" => "ok", "data" => $questions];
        return response()->json($res);
    }
}
