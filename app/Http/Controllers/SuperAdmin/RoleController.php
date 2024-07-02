<?php
namespace App\Http\Controllers\SuperAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Validator;
use App\User;
class RoleController extends Controller
{
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //$user = User::where('id', 1)->first();
        //$role_r = Role::where('id', '=', 1)->firstOrFail();  
        //$user->assignRole($role_r);
        //dd($user->getRoleNames());
        //dd($role_r); 
        Permission::create(['name' => 'admin']);
        dd('done');        
        return view('home');
    } 

    public function add_role(Request $request){
        $request->validate([
            'role_title' => 'required',
        ]);
        //Permission::create(['name' =>  $request->role_title]);
        Role::create(['name' =>  $request->role_title]);

        dd('done'); 
    }

    public function assign_role(Request $request){
        $request->validate([
            'user_id' => 'required',
            'role_id' => 'required',
        ]);
        $user = User::where('id', $request->user_id)->first();
        $role_r = Role::where('id', '=', $request->role_id)->firstOrFail();  
        $user->assignRole($role_r);
        dd($user->getRoleNames());
    }
 

}

