<?php

// inicio
Breadcrumbs::for('inicio', function ($trail) {
    $trail->push('Inicio', url('/'));
});

Breadcrumbs::for('home', function ($trail) {
    $trail->parent('inicio');
    $trail->push('Administración', route('home'));
});
Breadcrumbs::for('login', function ($trail) {
    $trail->parent('inicio');
    $trail->push('Acceder', route('login'));
});

Breadcrumbs::for('restablecerContrasenia', function ($trail) {
    $trail->parent('login');
    $trail->push('Restablecer contraseña', url('/password/reset'));
});

// peril de usuario

Breadcrumbs::for('miPerfil', function ($trail) {
    $trail->parent('home');
    $trail->push('Mi perfil', route('miPerfil'));
});
// periodos
Breadcrumbs::for('periodos', function ($trail) {
    $trail->parent('home');
    $trail->push('Períodos', route('periodos'));
});
Breadcrumbs::for('editarPeriodo', function ($trail,$periodo) {
    $trail->parent('periodos');
    $trail->push('Editar período', route('editarPeriodo',$periodo->id));
});


// cursos
Breadcrumbs::for('cursos', function ($trail,$tipo,$periodo) {
    $trail->parent('periodos');
  
    $trail->push('Cursos de '.$tipo, route('cursos',['tipo'=>$tipo,'periodo'=>$periodo->id]));
});

// estudiantes

Breadcrumbs::for('estudiantes', function ($trail,$paralelo) {
    $trail->parent('cursos',$paralelo->cursoPeriodo->curso->tipo,$paralelo->cursoPeriodo->periodo);
    $trail->push('Estudiantes de '.$paralelo->nombre, route('estudiantes',$paralelo->id));
});
Breadcrumbs::for('nuevoEstudiante', function ($trail,$paralelo) {
    $trail->parent('estudiantes',$paralelo);
    $trail->push('Nuevo estudiante en '.$paralelo->nombre, route('nuevoEstudiante',$paralelo->id));
});
Breadcrumbs::for('importarEstudianteExcel', function ($trail,$paralelo) {
    $trail->parent('estudiantes',$paralelo);
    $trail->push('Importar estudiante en '.$paralelo->nombre, route('importarEstudianteExcel',$paralelo->id));
});

Breadcrumbs::for('editarEstudiante', function ($trail,$estudiante) {
    $trail->parent('estudiantes',$estudiante->paralelo);
    $trail->push('Actualizar de '.$estudiante->user->name, route('estudiantes',$estudiante->id));
});

// mensajes

Breadcrumbs::for('reportesMensajes', function ($trail,$paralelo) {
    $trail->parent('estudiantes',$paralelo);
    $trail->push('Reportes de '.$paralelo->nombre, route('reportesMensajes',$paralelo->id));
});

Breadcrumbs::for('listaMensajes', function ($trail,$fecha) {
    $trail->parent('reportesMensajes',$fecha->paralelo);
    $trail->push('Fecha '.$fecha->fecha, route('listaMensajes',$fecha->id));
});

Breadcrumbs::for('mensajeXestudiante', function ($trail,$estudiante) {
    $trail->parent('estudiantes',$estudiante->paralelo);
    $trail->push('Listado de mensajes', route('mensajeXestudiante',$estudiante->id));
});

// registro de actividades
Breadcrumbs::for('registroActividades', function ($trail) {
    $trail->parent('home');
    $trail->push('Registro de actividades', route('registroActividades'));
});



//D:Breadcrums de roles y permisos
Breadcrumbs::for('roles', function ($trail) {
    $trail->parent('home');
    $trail->push('Roles', route('roles'));
});
Breadcrumbs::for('permisos', function ($trail,$rol) {
    $trail->parent('roles');
    $trail->push('Permisos', route('permisos',$rol->id));
});

// usarios
Breadcrumbs::for('usuarios', function ($trail) {
    $trail->parent('home');
    $trail->push('Usuarios', route('usuarios'));
});
Breadcrumbs::for('editarUsuario', function ($trail,$user) {
    $trail->parent('usuarios');
    $trail->push('Editar usuario', route('editarUsuario',$user->id));
});



