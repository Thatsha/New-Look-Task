<?php


namespace App\Repositories;


use App\Interfaces\User\UserInterface;
use App\Mail\UserEmail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserRepository implements UserInterface
{
    public function index(Request $request=null)
    {
        $users = User::where(function ($q) use ($request){
            $request->name?$q->where('name','like', '%'.$request->name.'%'):'';
            $request->email?$q->where('email','like', '%'.$request->email.'%'):'';
            $q->whereHas('roles', function ($qry) use ($request){
                $request->role?$qry->where('id', $request->role):'';
            });
        })->get();
        return $users;
    }

    public function store(Request $request)
    {
        $obj=new User();
        $obj->name=$request->name;
        $obj->email=$request->email;
        $obj->phone=$request->phone;
        $tempPassword=Str::random(8);
        $request->password?$obj->password=bcrypt($request->password):$obj->password=bcrypt($tempPassword);
        $obj->save();
        $obj->assignRole([$request->role]);

        return $obj;
    }



    public function show($id)
    {
        return User::find($id);

    }

    public function update(Request $request, $id)
    {
        try {

            $obj = User::find($id);
            $obj->name = $request->name;
            $obj->email = $request->email;
            $obj->phone=$request->phone;
            ($request->password) ? $obj->password = bcrypt($request->password) : "";
            $obj->save();
            if ($request->role) {
                $obj->roles()->detach();
                $obj->assignRole([$request->role]);
            }

            return $obj;
        }
        catch (Exception $exception) {
            return $this->exceptionErrorResponse($exception);
        }
    }

    public function delete($id)
    {
        $user= User::find($id);
        $user->delete();
    }



}
