<?php


namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\TestInput;
use Illuminate\Http\Request;


class TestInputController extends Controller
{


    /**
     * TestInputController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function get()
    {

        $test = TestInput::all();
        $res = ["status" => "ok", "data" => $test];
        return response()->json($res, 200);
    }
   /* public function create(Request $request)
    {
        echo("here");
        $Test_id = $request->test_id;
        $data = json_decode($request->getContent());
        $input = $data->input;
        $resultArray = [];

        foreach ($input as  $in) {
            $key=key($in);
            //echo(key($input)."=".$in."\n");
            //next($input);
            $tmp_input = new TestInput();
            $tmp_input->test_id = $Test_id;
            $tmp_input->question_id = key($in);
            $tmp_input->answer_id = $in->$key;
            $tmp_input->save();
            array_push($resultArray, $tmp_input);
            next($input);


        }
        // $test = new Test;

       // $test->save();
        $res = ["status" => "ok", "data" => "ok"];
        return response()->json($resultArray, 200);
    }*/
     public function create(Request $request)
    {
        //echo("here");
        //$Test_id = $request->test_id;
        $data = json_decode($request->getContent());
        $input = $data->input;
        $resultArray = [];

        foreach ($input as  $in) {
            $key=key($in);
            //echo(key($input)."=".$in."\n");
            //next($input);
            $tmp_input = TestInput::find(key($in));
            //$tmp_input->test_id = $Test_id;
            //$tmp_input->question_id = key($in);
            $tmp_input->answer_id = $in->$key;
            $tmp_input->save();
            array_push($resultArray, $tmp_input);
            next($input);


        }
        // $test = new Test;

       // $test->save();
        $res = ["status" => "ok", "data" => "ok"];
        return response()->json($resultArray, 200);
    }
}
