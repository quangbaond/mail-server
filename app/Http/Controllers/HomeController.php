<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
    public function index()
    {
        return view('welcome');
    }

    public function adminUser(Request $request)
    {
        $keyword = $request->get('keyword', '');
        $status = $request->get('status', '');
        if($status == 'active'){
           $users = User::where('status', 1)->where('id' , '!=', 1)->orderBy('created_at', 'desc')->paginate(10);
        }else if($status == 'inactive'){
              $users = User::where('status', 0)->where('id' , '!=', 1)->orderBy('created_at', 'desc')->paginate(10);
        }else {
            $users = User::paginate(10);
        }

        if ($keyword) {
            $users = User::where('name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->where('id' , '!=', 1)
                ->paginate(10);
        } else {
            $users = User::orderBy('created_at', 'desc')->where('id' , '!=', 1)->paginate(10);
        }

        return view('admin.user', compact('users', 'keyword', 'status'));
    }
    public function adminUserActive($id)
    {
        $user = User::findOrFail($id);
        $user->status = !$user->status;
        $user->save();
        return redirect()->route('admin.users.index');
    }
    public function adminDelete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index');
    }

}
