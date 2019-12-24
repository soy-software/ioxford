<?php

namespace iouesa\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        return view('home');
    }

    public function perfil()
    {
        $user=Auth::user();
        return view('auth.perfil',['user'=>$user]);
    }

    public function actualizarMiPerfil(Request $request)
    {
        $letras='/^[\pL\s\-]+$/u';
        $request->validate([
            'name' => 'required|max:191|regex:'.$letras,
            'password' => 'nullable|string|min:8|confirmed'
        ]);
        $user=Auth::user();
        $user->name=$request->name;
        if($request->password){
            $user->password=Hash::make($request->password);
        }
        $user->save();
        $request->session()->flash('success','Perfil actualizado exitosamente');
        return redirect()->route('miPerfil');
    }
}
