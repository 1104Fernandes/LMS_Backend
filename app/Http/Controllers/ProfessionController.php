<?php


namespace App\Http\Controllers;


use App\Models\Gender;
use App\Models\Profession;
use Illuminate\Http\Request;

class ProfessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['get']]);
    }
    public function get()
    {
        $gender = Profession::all();
        $res = ["status" => "ok", "data" => $gender];
        return response()->json($res, 200);
    }
    public function create(Request $request)
    {
        $profession = new Profession();
        $output = new \Symfony\Component\Console\Output\ConsoleOutput();
        $output->writeln($request->user_id);
        if (isset($request->profession)) {
            $profession->profession = $request->profession;
            $profession->save();
            $res = ["status" => "ok", "data" => $profession];
            return response()->json($res, 200);
        } else {
            return response()->json("", 400);
        }
    }
}
