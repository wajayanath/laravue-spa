<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

    /**
     * @OA\Schema(
     *   title="Update customer request",
     *   description="Update Customer request body data",
     * )
     */

class CustomerUpdateRequest extends FormRequest
{
   /**
     * @OA\Property(
     *   title="first_name",
     * )
     *
     * @var string
     */
    public $first_name;

    /**
     * @OA\Property(
     *   title="last_name",
     * )
     *
     * @var string
     */
    public $last_name;

        /**
     * @OA\Property(
     *   title="email",
     * )
     *
     * @var string
     */
    public $email;

        /**
     * @OA\Property(
     *   title="phone_number",
     * )
     *
     * @var string
     */
    public $phone_number;

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
        ];
    }
}
