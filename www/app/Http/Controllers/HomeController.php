<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $sort = $request->input('sort');
        $direction = $request->input('direction');
        $itemsPerPage = $request->input('items',10);
        $searchText = null;

        $users = User::query();
        if ($request->input('searchText')) {
            $searchText = $request->input('searchText');
            $users = $users->where('name', 'like', "%{$searchText}%")
                ->orWhere('email', 'like', "%{$searchText}%")
                ->orWhere('phone_number', 'like', "%{$searchText}%")
                ->orWhere('num_docm_identity', 'like', "%{$searchText}%");
        }

        $users = (!Auth::user()->is_admin) ? $users->where('id', '=', Auth::user()->id) : $users;



        $users = ($sort && $direction ) ? $users->orderBy($sort, $direction) : $users;

        $users = $users->paginate($itemsPerPage);


        return view('home', [ 'users' => $users, 'items' => $itemsPerPage, 'searchText' => $searchText ]);
    }
}
