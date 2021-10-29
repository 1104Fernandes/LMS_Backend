<?php


namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Test;
use App\Models\TestInput;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['get']]);
    }

    public function get()
    {
        $category = Category::all();
        $res = ["status" => "ok", "data" => $category];
        return response()->json($res);
    }

    

    public function create(Request $request)
    {
        $category =  new Category();
        $category->category_name = $request->category_name;
        $category->save();
        $res = ["status" => "ok", "data" => $category];
        return response()->json($res);
    }

    public function show($id)
    {
        $category = Category::find($id);
        $res = ["status" => "ok", "data" => $category];
        return response()->json($res);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        $category->category_name = $request->input('category_name');

        $category->save();
        $res = ["status" => "ok", "data" => $category];
        return response()->json($res);
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        $res = ["status" => "ok", "data" => $category];
        return response()->json($res);
    }

    public function getQuestions($id)
    {
        $questions = Category::find($id)->questions;
        $res = ["status" => "ok", "data" => $questions];
        return response()->json($res);
    }
}
