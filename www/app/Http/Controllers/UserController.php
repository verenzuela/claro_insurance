<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use App\Models\Country;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    const EDIT = 'edit';
    const DELETE = 'delete';

    /**
     * Update or delete user, only admin user can delete, show message when user attempt to delete and not is admin
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function action(Request $request): \Illuminate\Http\JsonResponse
    {
        if($request->ajax())
        {
            switch ($request->input('action')) {
                case self::EDIT:
                    $this->updateData($request);
                    break;
                case self::DELETE:
                    $this->deleteData($request);
                    break;
            }

            $return = (!Auth::user()->is_admin) ? ["message" => __('validation.no_has_permission') ] : $request;
            return response()->json($return);
        }
    }

    /**
     * Update user
     * @param Request $request
     */
    protected function updateData(Request $request)
    {
        $user = User::find($request->input('id'));
        $user->setAttribute('name', $request->input('Name'));
        $user->setAttribute('phone_number', $request->input('labels_phone_number'));
        $user->save();
    }

    /**
     * Delete user, if the logged in user is not the admin then return false
     * @param Request $request
     * @return bool
     */
    protected function deleteData(Request $request)
    {
        if(!Auth::user()->is_admin){
            return false;
        }
        $user = User::find($request->input('id'));
        return $user->forceDelete();
    }

    public function createNewUser() 
    {   
        if (!Auth::user()->is_admin) {
            return redirect()->route('home');            
        }

        $countries = Country::all();
        return view('user-create', ['countries' => $countries]);
    }

    public function storeNewUser(CreateUserRequest $request)
    {   
        User::create([
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'name' => $request->input('name'),
            'phone_number' => $request->input('phone_number'),
            'num_docm_identity' => $request->input('num_docm_identity'),
            'city_id' => $request->input('city_id'),
            'date_of_birth' => date('Y-m-d', strtotime($request->input('date_of_birth')))
        ]);

        return redirect()->route('home');
    }
}
