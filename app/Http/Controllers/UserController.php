<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
    * @OA\GET(
    * path="/api/users",
    * operationId="getAdminUsersList",
    * tags={"Admin User"},
    * security={{"bearerAuth": {}}},
    * summary="Get list of Admin Users",
    * description="Return list of Admin Users",
    * @OA\Response(
    * response=200,
    * description="Successful operation",
    * @OA\MediaType(
    * mediaType="application/json",
    * )
    * ),
    * @OA\Response(
    * response=401,
    * description="Unauthenticated",
    * @OA\JsonContent(
    * @OA\Property(property="message", type="string", example="Not authorized"),
    * )
    * ),
    * @OA\Response(
    * response=403,
    * description="Forbidden"
    * ),
    * )
    */
    public function index()
    {
        // \Gate::authorize('view', 'users');

        return User::paginate();
    }

    public function store(Request $request)
    {
        //
    }

    /**
    * @OA\GET(
    * path="/api/users/{id}",
    * tags={"Admin User"},
    * security={{"bearerAuth": {}}},
    * summary="Get a Admin User by id",
    * description="Admin User by id",
    * @OA\Parameter(
    * name="id",
    * description="User Id",
    * in="path",
    * required=true,
    * @OA\Schema(
    * type="integer"
    *   )
    * ),
    * @OA\Response(
    * response=200,
    * description="Successful operation",
    * @OA\MediaType(
    * mediaType="application/json",
    * )
    * ),
    * @OA\Response(
    * response=401,
    * description="Unauthenticated",
    * @OA\JsonContent(
    * @OA\Property(property="message", type="string", example="Not authorized"),
    * )
    * ),
    * @OA\Response(
    * response=403,
    * description="Forbidden"
    * ),
    * )
    */
    public function show(User $user)
    {
       return User::find($user);
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }

    /**
    * @OA\GET(
    * path="/api/user",
    * tags={"Admin User"},
    * security={{"bearerAuth": {}}},
    * summary="Authenticated Admin User",
    * description="Return Authenticated Admin User",
    * @OA\Response(
    * response=200,
    * description="Successful operation",
    * @OA\MediaType(
    * mediaType="application/json",
    * )
    * ),
    * @OA\Response(
    * response=401,
    * description="Unauthenticated",
    * @OA\JsonContent(
    * @OA\Property(property="message", type="string", example="Not authorized"),
    * )
    * ),
    * @OA\Response(
    * response=403,
    * description="Forbidden"
    * ),
    * )
    */
    public function user()
    {
        return \Auth::user();
    }
}
