<?php

namespace ioxford\Http\Controllers;

use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function index($paralelo)
    {
        return $paralelo;
    }
}
