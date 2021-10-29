<?php


namespace App\Http\Controllers;


use App\Models\Answer;
use App\Models\Classification;
use App\Models\selfAssessment;
use http\Env\Request;

class ClassificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getAllFromUser($id)
    {
        $Classification = Classification::get();
        $res = ["status" => "ok", "data" => $Classification];
        return response()->json($res);
    }
    public function getSpecific(\Illuminate\Http\Request $request)
    {

        $classification=Classification::where([
            ['userId', '=', $request->user_id],
            ['category_id', '=', $request->category_id]
        ])->get();
        $res = ["status" => "ok", "data" => $classification];
        return response()->json($res);
    }
    public function create(\Illuminate\Http\Request $request)
    {
        $classification = new Classification();
        $output = new \Symfony\Component\Console\Output\ConsoleOutput();
        $output->writeln($request->user_id);
        if (isset($request->user_id) && isset($request->category_id) && isset($request->difficult_id)) {
            $classification->user_id = $request->user_id;
            $classification->category_id = $request->category_id;
            $classification->difficult_id = $request->difficult_id;
            $classification->save();
            $res = ["status" => "ok", "data" => $classification];
            return response()->json($res, 200);
        } else {
            return response()->json("", 400);
        }
    }
}

