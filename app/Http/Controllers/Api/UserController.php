<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /*
    |-------------------------------------------------
    | Retrieve a paginated list of users with search and filter options
    |-------------------------------------------------
    */
    public function index(Request $request)
    {
        try {
            $users = User::filter($request->all())
            ->paginate($request->input('perPage', 20))
            ->appends($request->query());
            return UserResource::collection($users);
        } catch (\Exception $e) {
            return response()->json([
                    'error' => 'An error occurred while retrieving users: ' . $e->getMessage(),
                    'success' => false,
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /*
    |-------------------------------------------------
    | Retrieve a single user by ID
    |-------------------------------------------------
    */
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json([
                'data' => new UserResource($user),
                'success' => true,
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'User not found: ' . $e->getMessage(),
                'success' => false,
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /*
    |-------------------------------------------------
    | Store a new user in the database
    |-------------------------------------------------
    */
    public function store(StoreUserRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'userCode' => $request->userCode,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'status' => $request->status,
                'Phone' => $request->Phone,
            ]);

            return response()->json([
                'data' => new UserResource($user),
                'success' => true,
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while creating user: ' . $e->getMessage(),
                'success' => false,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /*
    |-------------------------------------------------
    | Update an existing user's details
    |-------------------------------------------------
    */
    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->update($request->validated());

            return response()->json([
                'data' => new UserResource($user),
                'success' => true,
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while updating user: ' . $e->getMessage(),
                'success' => false,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /*
    |-------------------------------------------------
    | Delete a user from the database
    |-------------------------------------------------
    */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json([
                'message' => 'User deleted successfully',
                'success' => true,
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while deleting user: ' . $e->getMessage(),
                'success' => false,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /*
    |-------------------------------------------------
    | Toggle the status of a user (Active/Inactive)
    |-------------------------------------------------
    */
    public function toggleStatus($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->update(['status' => $user->status == 'Active' ? 'Inactive' : 'Active']);

            return response()->json([
                'data' => new UserResource($user),
                'success' => true,
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while toggling status: ' . $e->getMessage(),
                'success' => false,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
