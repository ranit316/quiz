<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class QuizController extends Controller
{
    public function adduser(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if ($validateData->fails()) {
            $message = $validateData->errors();
            return response()->json(responseData(null, $message, false));
        }

        try {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->password),
            ]);
            return response()->json(responseData($user, "Added successfully", true));
        } catch (\Exception $e) {
            return response()->json(responseData(null, $e->getMessage(), false));
        }
    }

    public function userlogin(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if ($validateData->fails()) {
            $message = $validateData->errors();
            return response()->json(responseData(null, $message, false));
        } else {
            $user =  User::where("email", $request->email)->first();
        }

        if (!$user) {
            return response()->json(responseData(null, "Record not matched with our records", false));
        }

        if (Hash::check($request->password, $user->password)) {
            $token = $user->createToken($user->id)->plainTextToken;
            $data['token'] = $token;

            return response()->json(responseData($data, "Login Successfully"));
        } else {
            return response()->json(responseData("", "Credential not match", false));
        }
    }

    public function quiz_list()
    {
        $quizzes = Quiz::has('question')->get();
        if ($quizzes) {
            return response()->json(responseData($quizzes, "data retrive successfullyu"));
        } else {
            return response()->json(responseData(null, "something went wrong", false));
        }
    }

    public function create_quiz(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'title' => 'required',
            'time_limit' => 'required|integer|min:1',
        ]);

        if ($validateData->fails()) {
            $message = $validateData->errors();
            return response()->json(responseData(null, $message, false));
        } else {
            $data = $request->all();
            $id = auth('sanctum')->user()->id;
            $data['user_id'] = $id;
            $store = Quiz::create($data);

            if($store) {
                return response()->json(responseData($store, "added successfully"));
            }else{
                return response()->json(responseData(null, "something went wrong", false));
            }
        }
    }
}
