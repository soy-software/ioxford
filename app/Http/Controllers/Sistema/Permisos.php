<?php

namespace iouesa\Http\Controllers\Sistema;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use iouesa\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Permisos extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:DECE','auth']);
    }

    public function index($idRol)
    {
        $rol=Role::findOrFail($idRol);
        $permisos=Permission::all();
        return view('sistema.permisos.index',['rol'=>$rol,'permisos'=>$permisos]);
    }

    public function sincronizar(Request $request)
    {
       $request->validate([
            "permisos"    => "nullable|array",
            "permisos.*"  => "nullable|exists:permissions,id",
            'rol'=>'required|exists:roles,id',
        ]);
        
        $rol=Role::findOrFail($request->rol);
        $rol->syncPermissions($request->permisos);

        activity()
                ->causedBy(Auth::user())
                ->performedOn($rol)
                ->log('Actualizo los permisos de rol '.$rol->name??'');


        $request->session()->flash('success','Permisos actualizados');
        return redirect()->route('permisos',$rol->id);
    }
}
