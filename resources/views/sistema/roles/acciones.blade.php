<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
    
    <a href="{{ route('permisos',$rol->id) }}" class="btn btn-info"  data-toggle="tooltip" data-placement="top" title="Permisos de {{ $rol->name }}">
        <i class="fas fa-key"></i>
    </a>
    @if($rol->name!='DECE' && $rol->name!='ESTUDIANTE' && $rol->name!='INSPECTOR DOS' && $rol->name!='INSPECTOR UNO')
    <button onclick="eliminar(this);" data-url="{{ route('eliminarRol') }}" data-id="{{ $rol->id }}" type="button" class="btn btn-unique" data-toggle="tooltip" data-placement="top" title="Eliminar {{ $rol->name }}">
        <i class="fas fa-trash-alt"></i>
    </button>
    @endif
</div>