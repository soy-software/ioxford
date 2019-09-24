<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
    @can('actualizar', $user)
        <a href="{{ route('editarUsuario',$user->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Editar">
            <i class="fas fa-edit"></i>
        </a>    

    
    <button type="button" class="btn btn-unique" data-url="{{ route('eliminarUsuario') }}" data-id="{{ $user->id }}" onclick="eliminar(this);" data-toggle="tooltip" data-placement="top" title="Eliminar" >
        <i class="fas fa-trash-alt"></i>
    </button>

    @endcan
</div>