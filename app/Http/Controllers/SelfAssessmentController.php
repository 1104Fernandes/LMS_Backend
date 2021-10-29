<?php


namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\selfAssessment;
use Illuminate\Http\Request;

class selfAssessmentController extends  Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function get()
    {
        $self = selfAssessment::all();
        $res = ["status" => "ok", "data" => $self];
        return response()->json($res, 200);
    }
    public function create(Request $request)
    {

        $self = new selfAssessment();
        $output = new \Symfony\Component\Console\Output\ConsoleOutput();
        $output->writeln($request->user_id);
        $exists = selfAssessment::where('user_id', '=', $request->user_id)->where('category_id','=',$request->category_id)->first();

        if(!$exists){

            if (isset($request->user_id) && isset($request->category_id) && isset($request->value)) {
                $self->user_id = $request->user_id;
                $self->category_id = $request->category_id;
                $self->value = $request->value;
                $self->save();
                $res = ["status" => "ok", "data" => $self];
                return response()->json($res, 200);
            } else {
                return response()->json("", 400);
            }
        }else{

            $res = ["status" => "done", "data" => ""];
            return response()->json($res, 200);
        }
    }
}
