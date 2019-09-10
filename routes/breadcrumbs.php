<?php

// inicio
Breadcrumbs::for('inicio', function ($trail) {
    $trail->push('Inicio', url('/'));
});

Breadcrumbs::for('home', function ($trail) {
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


