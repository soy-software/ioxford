<?php

namespace iouesa\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class RegistroActividades extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:DECE','auth']);
    }

    public function index()
    {
        $lastActivity = Activity::all();
        $data = array('registroActividades' => $lastActivity );
        return view('registroActividades.index',$data);
    }
}
