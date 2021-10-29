<?php


namespace App\Http\Controllers;


use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends \Laravel\Lumen\Routing\Controller
{

    public function create(Request $request)
    {
        $j=new Job();
        $j->job_id=$request->job_id;
        $j->job_name=$request->job_name;
        $j->save();
    }
    public function get(Request $request)
    {
        $job=Job::all();
        $res = ["status" => "ok", "data" => $job];
        return response()->json($res, 200);

    }

}
