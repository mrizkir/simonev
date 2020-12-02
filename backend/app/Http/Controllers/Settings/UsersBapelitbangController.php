<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Ramsey\Uuid\Uuid;
use Illuminate\Validation\Rule;

class UsersBapelitbangController extends Controller {         
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {           
        $this->hasPermissionTo('USERS BAPELITBANG_BROWSE');
        $data = User::role('bapelitbang')
                    ->orderBy('username','ASC')
                    ->get();       
                    
        $role = Role::findByName('bapelitbang');
        return Response()->json([
                                'status'=>1,
                                'pid'=>'fetchdata',
                                'role'=>$role,
                                'users'=>$data,
                                'message'=>'Fetch data users Bapelitbang berhasil diperoleh'
                            ],200);  
    }    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->hasPermissionTo('USERS BAPELITBANG_STORE');
        $this->validate($request, [
            'name'=>'required',
            'email'=>'required|string|email|unique:users',            
            'username'=>'required|string|unique:users',
            'password'=>'required',                        
        ]);
        $user = \DB::transaction(function () use ($request){
            $now = \Carbon\Carbon::now()->toDateTimeString();        
            $user=User::create([
                'id'=>Uuid::uuid4()->toString(),
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),                
                'username'=> $request->input('username'),
                'password'=>Hash::make($request->input('password')),                        
                'theme'=>'default',                
                'foto'=> 'storage/images/users/no_photo.png',
                'created_at'=>$now, 
                'updated_at'=>$now
            ]);            
            $role='bapelitbang';   
            $user->assignRole($role);               
            
            $permission=Role::findByName('bapelitbang')->permissions;
            $permissions=$permission->pluck('name');
            $user->givePermissionTo($permissions);    

            $daftar_roles=json_decode($request->input('role_id'),true);
            foreach($daftar_roles as $v)
            {
                if ($v!='bapelitbang')
                {
                    $user->assignRole($v);               
                    $permission=Role::findByName($v)->permissions;
                    $permissions=$permission->pluck('name');
                    $user->givePermissionTo($permissions);                                    
                }               
            }

            \App\Models\Settings\ActivityLog::log($request,[
                                            'object' => $this->guard()->user(), 
                                            'object_id' => $this->getUserid(), 
                                            'user_id' => $this->getUserid(), 
                                            'message' => 'Menambah user Bapelitbang('.$user->username.') berhasil'
                                        ]);

            return $user;
        });

        return Response()->json([
                                    'status'=>1,
                                    'pid'=>'store',
                                    'user'=>$user,                                    
                                    'message'=>'Data user Bapelitbang berhasil disimpan.'
                                ],200); 

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->hasPermissionTo('USERS BAPELITBANG_UPDATE');

        $user = User::find($id);
        if (is_null($user))
        {
            return Response()->json([
                                    'status'=>0,
                                    'pid'=>'update',                
                                    'message'=>["User ID ($id) gagal diupdate"]
                                ],422); 
        }
        else
        {
            $this->validate($request, [
                                        'username'=>[
                                                        'required',
                                                        'unique:users,username,'.$user->id
                                                    ],           
                                        'name'=>'required',            
                                        'email'=>'required|string|email|unique:users,email,'.$user->id,                                                                                
                                    ]); 
            
            $user = \DB::transaction(function () use ($request,$user){
                $user->name = $request->input('name');
                $user->email = $request->input('email');                
                $user->username = $request->input('username');        
                if (!empty(trim($request->input('password')))) {
                    $user->password = Hash::make($request->input('password'));
                }    
                $user->updated_at = \Carbon\Carbon::now()->toDateTimeString();
                $user->save();

                $user->syncRoles(['bapelitbang']);

                $daftar_roles=json_decode($request->input('role_id'),true);   
                foreach($daftar_roles as $v)
                {
                    if ($v!='bapelitbang')
                    {
                        $user->assignRole($v);               
                        $permission=Role::findByName($v)->permissions;
                        $permissions=$permission->pluck('name');
                        $user->givePermissionTo($permissions);                                    
                    }    
                }
                \App\Models\Settings\ActivityLog::log($request,[
                                                            'object' => $this->guard()->user(), 
                                                            'object_id' => $this->getUserid(), 
                                                            'user_id' => $this->getUserid(), 
                                                            'message' => 'Mengubah data user Bapelitbang ('.$user->username.') berhasil'
                                                        ]);
                return $user;
            });
            
            return Response()->json([
                                    'status'=>1,
                                    'pid'=>'update',
                                    'user'=>$user,      
                                    'message'=>'Data user Bapelitbang '.$user->username.' berhasil diubah.'
                                ],200); 
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    { 
        $this->hasPermissionTo('USERS BAPELITBANG_DESTROY');

        $user = User::where('isdeleted','1')
                    ->find($id); 
        
        if (is_null($user))
        {
            return Response()->json([
                                    'status'=>0,
                                    'pid'=>'destroy',                
                                    'message'=>["User ID ($id) gagal dihapus"]
                                ],422); 
        }
        else
        {
            $username=$user->username;
            $user->delete();

            \App\Models\Settings\ActivityLog::log($request,[
                                                                'object' => $this->guard()->user(), 
                                                                'object_id' => $this->getUserid(), 
                                                                'user_id' => $this->getUserid(), 
                                                                'message' => 'Menghapus user Bapelitbang ('.$username.') berhasil'
                                                            ]);
        
            return Response()->json([
                                        'status'=>1,
                                        'pid'=>'destroy',                
                                        'message'=>"User Bapelitbang ($username) berhasil dihapus"
                                    ],200);         
        }
                  
    }
}