<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Resources\CustomerResource;
use App\Http\Requests\CustomerCreateRequest;
use App\Http\Requests\CustomerUpdateRequest;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{

    /**
    * @OA\GET(
    * path="/api/customers",
    * tags={"Customers"},
    * security={{"bearerAuth": {}}},
    * summary="Customers",
    * description="Return list of all Customers",
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
    public function index(Request $request)
    {


        $search = $request->input('s');

        if ($search!="") {
            $customers = Customer::where(function ($query) use ($search) {
                $query->whereRaw("first_name LIKE '%{$search}%'")
                  ->orWhereRaw("last_name LIKE '%{$search}%'")
                  ->orWhereRaw("email LIKE '%{$search}%'")
                  ->orWhereRaw("phone_number LIKE '%{$search}%'");
            })
            ->paginate(10);
            $customers->append(['s' => $search]);
        }
        else {
            $customers = Customer::paginate(10);
        }
        return CustomerResource::collection($customers);
    }

    /**
    * @OA\POST(
    * path="/api/customers",
    * tags={"Customers"},
    * security={{"bearerAuth": {}}},
    * summary="Add a new Customer",
    * description="Add a new Customer",
    * @OA\RequestBody(
    *  required=true,
    *  @OA\JsonContent(ref="#/components/schemas/CustomerCreateRequest")
    * ),
    * @OA\Response(
    *  response=201,
    *  description="Successful operation",
    * @OA\MediaType(
    *  mediaType="application/json",
    * )
    * ),
    * @OA\Response(
    *  response=401,
    *  description="Unauthenticated",
    * @OA\JsonContent(
    * @OA\Property(property="message", type="string", example="Not authorized"),
    * )
    * ),
    * @OA\Response(
    *  response=403,
    *  description="Forbidden"
    * ),
    * )
    */

    public function store(CustomerCreateRequest $request)
    {
        $customer = Customer::create(
            $request->only('first_name','last_name','email','phone_number')
        );

        return response($customer, Response::HTTP_CREATED);
    }

    /**
    * @OA\GET(
    * path="/api/customers/{id}",
    * tags={"Customers"},
    * security={{"bearerAuth": {}}},
    * summary="Get a Customer by id",
    * description="Customer User by id",
    * @OA\Parameter(
    * name="id",
    * description="Customer Id",
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

    public function show($id)
    {
        return new CustomerResource(Customer::find($id));
    }

/**
    * @OA\PUT(
    * path="/api/customers/{id}",
    * tags={"Customers"},
    * security={{"bearerAuth": {}}},
    * summary="Update a Customer by id",
    * description="Customer update by id",
    * @OA\Parameter(
    * name="id",
    * description="Customer Id",
    * in="path",
    * required=true,
    * @OA\Schema(
    * type="integer"
    *   )
    * ),
    * @OA\RequestBody(
    *  required=true,
    *  @OA\JsonContent(ref="#/components/schemas/CustomerUpdateRequest")
    * ),
    * @OA\Response(
    * response=202,
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

    public function update(CustomerUpdateRequest $request, $id)
    {
        $customer = Customer::find($id);

        $customer->update(
            $request->only('first_name','last_name','email','phone_number')
        );

        return response($customer, Response::HTTP_ACCEPTED);
    }

        /**
    * @OA\DELETE(
    * path="/api/customers/{id}",
    * tags={"Customers"},
    * security={{"bearerAuth": {}}},
    * summary="Delete a Customer by id",
    * description="Customer delete by id",
    * @OA\Parameter(
    * name="id",
    * description="Customer Id",
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

    public function destroy($id)
    {
        Customer::destroy($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
