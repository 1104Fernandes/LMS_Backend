<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use PHPUnit\Exception;
use App\Models\selfAssessment;

class UserController extends Controller
{
    /**
     * Create a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request)
    {

        if (User::where('nickname', '=', $request->nickname)->first() === null) {
            //$output = new \Symfony\Component\Console\Output\ConsoleOutput();
            //$output->writeln($request);
            $user = new User();
            $user->nickname = $request->nickname;
            $user->password = app('hash')->make($request->password, ['rounds' => 12]);
            $user->gender_id = ($request->gender_id === 0) ? null : $request->gender_id;
            $user->age = ($request->age === 0) ? null : $request->age;
            $user->profession_id = ($request->profession_id === 0) ? null : $request->profession_id;
            $user->e_mail= $request->e_mail;
            $user->job_id=$request->job_id;
            $self = $request->self_assesment;

            try {
                $user->save();
                $token = Auth::login($user);
            } catch (\Exception $e) {
                echo ($e);
            }


            return $this->respondWithToken($token);
        } else {
            return response()->json(['error' => 'Username exists'], 401);
        }
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        try {
            if (User::where('nickname', '=', $request->nickname)->first() === null) {
                return response()->json(['error' => 'User does not exist'])->setStatusCode(500);
            }

            $credentials = $request->only(['nickname', 'password']);
            if (!$token = Auth::attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (Exception $e) {
            echo ($e);
        }

        $user = User::where('nickname', '=', $request->nickname)->first();
        $user_id = $user->user_id;
        $nickname = $user->nickname;
        $user_rights = $user->user_rights_id;


        $arr = ["access_token" => $token, "user_id" => $user_id, "nickname" => $nickname, "user_rights_id" => $user_rights];
        $res = ["status" => "ok", "data" => $arr];
        return response()->json($res, 200);

        //return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        return response()->json($request->user());
        // return response()->json(Auth::user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }
    public function getClassification(Request $req)
    {
        //echo($req->user_id);
         $classification=User::find($req->user_id)->classification;
        $res = ["status" => "ok", "data" => $classification];
        return response()->json($res);
    }
    public function  getSelfAssessment(Request  $req)
    {
        $selfAssessment=User::find($req->user_id)->selfAssessment;
        $res = ["status" => "ok", "data" => $selfAssessment];
        return response()->json($res);
    }
    public function Job(Request $req)
    {
        //echo($req->user_id);
        $job=User::find($req->user_id)->job;
        $res = ["status" => "ok", "data" => $job];
        return response()->json($res);
    }
}
