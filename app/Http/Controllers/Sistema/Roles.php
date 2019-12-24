<?php

namespace iouesa\Http\Controllers\Sistema;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use iouesa\Http\Controllers\Controller;
use iouesa\DataTables\Sistema\RolesDataTable;
use Spatie\Permission\Models\Role;
class Roles extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:DECE','auth']);
    }

    public function index(RolesDataTable $dataTable)
    {
        return $dataTable->render('sistema.roles.index');
    }

    public function guardar(Request $request)
    {
        $validatedData = $request->validate([
            'rol' => 'required|unique:roles,name|max:255',
        ]);
        $role=Role::create(['name' => $request->rol]);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($role)
            ->log('Creo un rol '.$role->name??'');


        $request->session()->flash('success','Rol ingresado');
        return redirect()->route('roles');
    }

    public function eliminar(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'id' => 'required|exists:roles,id',
            ]);
            $rol=Role::findOrFail($request->id);
            if($rol->users->count()>0){
                return response()->json(['default'=>'No se puede eliminar rol, ya que existe usuarios asignados']);
            }else{

                if($rol->name!='Administrador' && $rol->name!='Coordinador' && $rol->name!='Gestor'){
                    $rol->delete();
                        
                    activity()
                ->causedBy(Auth::user())
                ->performedOn($rol)
                ->log('Elimino un rol '.$rol->name??'');

                    return response()->json(['success'=>'Rol eliminado']);
                    
                }else {
                    return response()->json(['default'=>'No puede eliminar este rol.']);
                }
                
            }
        } catch (\Exception $th) {
            return response()->json(['default'=>'No se puede eliminar rol']);
        }
    }
}
