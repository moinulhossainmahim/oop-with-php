<?php

namespace App\Traits;

trait ApiResponse
{
  protected function success($data = null, $message = 'Success', $status = 200)
  {
    return response()->json([
        'status' => 'success',
        'message' => $message,
        'data' => $data
    ], $status);
  }

  protected function error($message = 'Error', $status = 400)
  {
    return response()->json([
        'status' => 'error',
        'message' => $message
    ], $status);
  }
}

// Usage

// use App\Traits\ApiResponse;

class UserController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $users = \App\Models\User::all();
        return $this->success($users, 'Fetched users');
    }
}
