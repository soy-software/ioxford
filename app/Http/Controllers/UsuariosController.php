<?php

namespace ioxford\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use ioxford\DataTables\UsuariosDataTable;
use ioxford\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
class UsuariosController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Usuarios','auth']);
    }

    public function index(UsuariosDataTable $dataTable)
    {
        $roles=Role::all();
        $data = array('roles' => $roles );
        return $dataTable->render('usuarios.index',$data);
    }

    public function guardar(Request $request)
    {

        $request->validate([
            'name' => 'required|alpha|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:8|confirmed',
            "roles"    => "nullable|array",
            "roles.*"  => "nullable|exists:roles,id",
        ]);
        $user= User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->save();
        $user->assignRole($request->roles);
         
        $request->session()->flash('success','Usuario ingresado');
        return redirect()->route('usuarios');
    }

    public function editar($idUser)
    {
        $user=User::findOrFail($idUser);
        $roles=Role::all();
        return view('usuarios.editar',['user'=>$user,'roles'=>$roles]);
    }
    public function eliminar(Request $request)
    {
        $request->validate([
            'user' => 'required|exists:users,id',
        ]);
        
        try {
            DB::beginTransaction();
            $user=User::findOrFail($request->user);
            if(Auth::user()->id!=$user->id){
                $user->delete();
                DB::commit();
                return response()->json(['success'=>'Usuario eliminado']);
                
            }else{
                return response()->json(['default'=>'No se puede autoeliminarse']);
            }
            
        } catch (\Exception $th) {
            DB::rollBack();
            return response()->json(['default'=>'No se puede eliminar usuario']);
        }
    }

    public function actualizar(Request $request)
    {
        $request->validate([
            'usuario'=>'required|exists:users,id',
            'name' => 'required|alpha|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$request->usuario,
            'password' => 'nullable|string|min:8|confirmed',
            "roles"    => "nullable|array",
            "roles.*"  => "nullable|exists:roles,id",
        ]);

        $user=User::findOrFail($request->usuario);
        $user->name=$request->name;
        $user->email=$request->email;
        if($request->password){
            $user->password=Hash::make($request->password);
        }
        $user->save();
        $user->syncRoles($request->roles);
        $request->session()->flash('success','Usuario actualizado');

        return redirect()->route('usuarios');
    }
}
