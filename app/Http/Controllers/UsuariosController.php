<?php

namespace iouesa\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use iouesa\DataTables\UsuariosDataTable;
use iouesa\User;
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
        $roles=Role::where('name','!=','DECE')->get();
        $data = array('roles' => $roles );
        return $dataTable->render('usuarios.index',$data);
    }

    public function guardar(Request $request)
    {
        $letras='/^[\pL\s\-]+$/u';
        $rolDece=Role::where('name','DECE')->first();
        $request->validate([
            'name' => 'required|max:191|regex:'.$letras,
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:8|confirmed',
            "roles"    => "nullable|array",
            "roles.*"  => "nullable|exists:roles,id|not_in:".$rolDece->id,
        ]);
        $user= User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->save();
        $user->assignRole($request->roles);
         
        activity()
        ->causedBy(Auth::user())
        ->performedOn($user)
        ->log('Creo el usuario '.$user->identificacion??'');


        $request->session()->flash('success','Usuario ingresado');
        return redirect()->route('usuarios');
    }

    public function editar($idUser)
    {
        $user=User::findOrFail($idUser);
        $roles=Role::where('name','!=','DECE')->get();
        return view('usuarios.editar',['user'=>$user,'roles'=>$roles]);
    }
    public function eliminar(Request $request)
    {
        $request->validate([
            'user' => 'required|exists:users,id',
        ]);
        $user=User::findOrFail($request->user);
        $this->authorize('actualizar', $user);
        try {
            DB::beginTransaction();
            if(Auth::user()->id!=$user->id){
                $user->delete();
                DB::commit();

                activity()
            ->causedBy(Auth::user())
            ->performedOn($user)
            ->log('Elimino al usuario '.$user->identificacion??'');

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
        $letras='/^[\pL\s\-]+$/u';
        $rolDece=Role::where('name','DECE')->first();
        $request->validate([
            'usuario'=>'required|exists:users,id',
            'name' => 'required|max:255|regex:'.$letras,
            'email' => 'required|string|email|max:255|unique:users,email,'.$request->usuario,
            'password' => 'nullable|string|min:8|confirmed',
            "roles"    => "nullable|array",
            "roles.*"  => "nullable|exists:roles,id|not_in:".$rolDece->id,
        ]);
            
        $user=User::findOrFail($request->usuario);
        $this->authorize('actualizar', $user);
        $user->name=$request->name;
        $user->email=$request->email;
        if($request->password){
            $user->password=Hash::make($request->password);
        }
        $user->save();

        activity()
            ->causedBy(Auth::user())
            ->performedOn($user)
            ->log('Actualizo al usuario '.$user->identificacion??'');


        $user->syncRoles($request->roles);
        $request->session()->flash('success','Usuario actualizado');

        return redirect()->route('usuarios');
    }
}
