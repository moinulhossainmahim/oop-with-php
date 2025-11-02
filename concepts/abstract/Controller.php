<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

// Can define a custom base controller for shared behavior.
abstract class Controller extends BaseController
{
    protected function success($data, $message = 'Success')
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ]);
    }

    protected function fail($message, $status = 400)
    {
        return response()->json(['error' => $message], $status);
    }
}

// Now in child controller
class UserController extends Controller
{
    public function index()
    {
        $users = \App\Models\User::all();
        return $this->success($users);
    }
}
