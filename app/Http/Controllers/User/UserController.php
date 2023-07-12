<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Interfaces\User\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $userInterface;

    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $this->userInterface->index($request);
        return response()->json($data, 200);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'role' => 'required',
            'email' => 'required|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->first(), 422);
        }
        $data = $this->userInterface->store($request);
        return response()->json($data, 200);
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $data = $this->userInterface->show($id);
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'role' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'phone' => 'required|unique:users,phone,' . $id,
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->first(), 422);
        }
        $data= $this->userInterface->update($request, $id);
        return response()->json($data, 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->userInterface->delete($id);
        return response()->json("deleted Success fully", 200);
    }


}
