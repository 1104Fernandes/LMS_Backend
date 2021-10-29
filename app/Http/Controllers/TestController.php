<?php


namespace App\Http\Controllers;

use App\Models\Classification;
use App\Models\Question;
use App\Models\Category;
use App\Models\TestInput;
use Illuminate\Http\Request;
use App\Models\Test;

class TestController extends Controller
{


    /**
     * TestController constructor.
     */
    public function __construct()
    {
        // $this->middleware('auth:api');
    }

    public function get()
    {

        $test = Test::all();
        $res = ["status" => "ok", "data" => $test];
        return response()->json($res, 200);
    }

    public function create(Request $request)
    {
        $test = new Test;
        $test->user_id = $request->user_id;
        $test->category_id = $request->category_id;


        $test->save();
        $res = ["status" => "ok", "data" => $test];
        return response()->json($res, 200);
    }

    public function getOne($id)
    {
        $test = Test::find($id);
        $res = ["status" => "ok", "data" => $test];
        return response()->json($res, 200);
    }

    public function update(Request $request, $id)
    {
        $test = Test::find($id);

        $test->ReachedPoints = $request->input('reached_points');
        $test->save();
        $res = ["status" => "ok", "data" => $test];
        return response()->json($res);
    }


    public function getFinaltest(Request $request)
    {
        $test_id = $request->test_id;
        $found = Test::where('user_id', '=', $request->user_id)
            ->where('finished_test', '=', 0)
            ->where('first_test', '=', 0)
            ->latest('test_id')->exists();

        $user_test = Test::where('user_id', '=', $request->user_id)
            ->where('finished_test', '=', 1)
            ->where('first_test', '=', 1)
            ->latest('test_id')->first();

        $class = Classification::where('userId', '=', $request->user_id)->where('category_id', '=', $user_test->category_id)->first();

        $difficult = $class->difficult_id;
        $category = $class->category_id;
        $created_test_id = null;
        $res = [];
        if (!$found) {

            //$questions =  Category::find($category)->questions->where('difficult_id', '=', $difficult)->random(10);
            $questions = Category::find($category)->questions->random(10);//->where('difficult_id', '=', $difficult)->random(10);
            $exitTest = new Test();
            $exitTest->user_id = $request->user_id;
            $exitTest->category_id = $category;
            $exitTest->first_test = 0;
            $exitTest->finished_test = 0;
            $exitTest->save();
            //$questions =  Category::find($category_id)->questions->where('difficult_id', '=', $difficult_id)->random(5);
            $created_test_id = $exitTest->test_id;
            //echo($questions);
            $j = 1;

            foreach ($questions as $quest) {
                $quest->answers;
                array_push($res, $quest);
                $ti = new TestInput();
                $ti->test_id = $created_test_id;
                $ti->question_id = $quest->question_id;
                $ti->save();
            }
        } else {
            $test = Test::where('user_id', '=', $request->user_id)
                ->where('finished_test', '=', 0)
                ->where('first_test', '=', 0)
                ->latest('test_id')->first();


            $questionsIds = [];
            $res = [];
            $tinput = $test->input;
            foreach ($tinput as $oneInput) {
                array_push($questionsIds, $oneInput->question_id);

            }
            $questions = Question::whereIn('question_id', $questionsIds)->get();
            foreach ($questions as $quest) {
                $quest->answers;
                $quest->test_id = $test->test_id;
                array_push($res, $quest);
            }
        }
        //$output = new \Symfony\Component\Console\Output\ConsoleOutput();
        //$output->writeln($res);        
        $finalres = ["status" => "ok", "data" => $res];
        return response()->json($finalres);

    }

    public function createEntryTest(Request $request)
    {
        $found = Test::where('user_id', '=', $request->user_id)
            ->where('category_id', '=', $request->category_id)
            ->where('first_test', '=', 1)
            ->where('finished_test', '=', 0)->exists();

        $category = Category::where('category_id', '=', $request->category_id)->first();
        //echo $category;
        if (!$found) {
            $after_test = new Test();
            $after_test->user_id = $request->user_id;
            $after_test->category_id = $request->category_id;
            $after_test->first_test = 1;
            $after_test->finished_test = 0;
            $after_test->save();


            $questionsEasy = Category::find($request->category_id)->questions->where('difficult_id', '=', 1)->random(5);
            $questionsMiddle = Category::find($request->category_id)->questions->where('difficult_id', '=', 2)->random(3);
            $questionsHard = Category::find($request->category_id)->questions->where('difficult_id', '=', 3)->random(2);
            $allQuestions = [];
            $res = [];
            $j = 1;

            foreach ($questionsEasy as $quest) {
                $quest->answers;
                $quest->test_id = $after_test->test_id;
                array_push($res, $quest);
                $ti = new TestInput();
                $ti->test_id = $after_test->test_id;
                $ti->question_id = $quest->question_id;
                $ti->save();
            }
            foreach ($questionsMiddle as $quest) {
                $quest->answers;
                $quest->test_id = $after_test->test_id;
                array_push($res, $quest);
                $ti = new TestInput();
                $ti->test_id = $after_test->test_id;
                $ti->question_id = $quest->question_id;
                $ti->save();
            }
            foreach ($questionsHard as $quest) {
                $quest->answers;
                $quest->test_id = $after_test->test_id;
                array_push($res, $quest);
                $ti = new TestInput();
                $ti->test_id = $after_test->test_id;
                $ti->question_id = $quest->question_id;
                $ti->save();
            }


        } else {
            $finalres = ["status" => "ok", "data" => "Sie haben bereits ein " . $category->category_name . " Test Absolviert"];

            $existingTest = Test::where('user_id', '=', $request->user_id)
                ->where('category_id', '=', $request->category_id)
                ->where('first_test', '=', 1)
                ->where('finished_test', '=', 0)->first();

            $questionsIds = [];
            $res = [];
            $tinput = $existingTest->input;
            foreach ($tinput as $oneInput) {
                array_push($questionsIds, $oneInput->question_id);

            }
            $questions = Question::whereIn('question_id', $questionsIds)->get();
            foreach ($questions as $quest) {
                $quest->answers;
                $quest->test_id = $existingTest->test_id;
                array_push($res, $quest);
            }
        }
        $finalres = ["status" => "ok", "data" => $res];
        return response()->json($finalres);

    }

    public function createTest(Request $request)
    {
        $found = Test::where('user_id', '=', $request->user_id)
            ->where('difficult_id', '=', $request->difficult_id)
            ->where('category_id', '=', $request->category_id)
            ->where('first_test', '=', 1)->exists();

        $category = Category::where('category_id', '=', $request->category_id)->first();
        //echo $category;
        if ($found) {
            $created = Test::where('user_id', '=', $request->user_id)
                ->where('difficult_id', '=', $request->difficult_id)
                ->where('category_id', '=', $request->category_id)
                ->where('first_test', '=', 0)->exists();
            if ($created) {
                $finalres = ["status" => "ok", "data" => "Sie haben bereits ein " . $category->category_name . " Test Absolviert"];
                return response()->json($finalres);
            } else {
                $after_test = new Test();
                $after_test->user_id = $request->user_id;
                $after_test->category_id = $request->category_id;
                $after_test->first_test = 0;
                $after_test->difficult_id = $request->difficult_id;
                $after_test->finished_test = 0;
                $after_test->save();
            }
        } else {
            $after_test = new Test();
            $after_test->user_id = $request->user_id;
            $after_test->category_id = $request->category_id;
            $after_test->first_test = 1;
            $after_test->difficult_id = $request->difficult_id;
            $after_test->finished_test = 0;
            $after_test->save();
        }
        $finalres = ["status" => "ok", "data" => $after_test];
        return response()->json($finalres);
    }

    //ON GOING
    public function finishTest(Request $request)
    {
        $submitObject = $request->submitObject;

        //$test_id = $request->test_id;
        $test_id = $submitObject['test_id'];
        $Test = Test::where('test_id', $test_id);
        $Test = $Test->first();

        $inputs = $Test->input;

        $points = 0;
        //$answers = $request->answers;
        $answers = $submitObject['answers'];
        $question_ids = [];
        $givenAnswers = [];
        $test = [];
        //var_dump($answers[0]["question_id"]);
        foreach ($answers as $key) {
            //$givenAnswers[key($key)]=$key[key($key)]; //als {"13:"34}  variante
            //$givenAnswers[$key["question_id"]]=$key["answer_id"];//als {"question_id":"34","answer_id":"12"} Variante
            $givenAnswers[$key[0]] = $key[1];//als "answers":[[13,93],[12,45]] Variante
            //echo(key($key));
            //echo($key[key($key)]);


        }

        foreach ($inputs as $input) {
            if (isset($givenAnswers[$input->question_id])) {

                $input->answer_id = $givenAnswers[$input->question_id];
                $input->save();
            }
            array_push($question_ids, $input->question_id);


        }

        $questions = Question::whereIn('question_id', $question_ids)->get(); //load from array

        foreach ($givenAnswers as $quest => $answer) {

            $tmp = $questions->where('question_id', '=', $quest)->first();
            $given_answer = $answer;
            $right_answer = $tmp->right_answer;
            //echo("question ".$i->question_id." given: ".$i->answer_id." right Answer:".$tmp->right_answer."\n");

            $output = new \Symfony\Component\Console\Output\ConsoleOutput();

            if ($given_answer == $right_answer) {
                $points++;
            }
        }

        $percentage = ($points / 10) * 100;

        $class = null;
        if ($Test->first_test) {

            $classification = new Classification();
            $classification->userId = $Test->user_id;
            $classification->category_id = $Test->category_id;


            if ($percentage > 80) {
                $classification->difficult_id = 3;
                $class = 3;
            } else if ($percentage < 80 && $percentage > 39) {
                $classification->difficult_id = 2;
                $class = 2;
            } else {
                $classification->difficult_id = 1;
                $class = 1;
            }
            $classification->save();

            //echo ($class);
            $Test->finished_test = true;
            $Test->reached_Points = $percentage;
            //$Test->difficult_id = $class;
            $Test->save();

            $finalres = ["status" => "ok", "data" => ["points" => $percentage, "difficult_id" => $class]];
            return response()->json($finalres);


        }
    }
}

