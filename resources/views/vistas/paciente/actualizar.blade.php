@if (Auth::user()->tipo_usuario==1)
@extends('layouts/app')
@section('titulo', 'Actualizar pacientes')
@section('content')
{{-- notificaciones --}}

@if (session('DUPLICADO'))
<script>
    $(function notificacion() {
                new PNotify({
                    title: "DUPLICADO",
                    type: "warning",
                    text: "{{ session('DUPLICADO') }}",
                    styling: "bootstrap3"
                });
            });
</script>
@endif

@if (session('CORRECTO'))
<script>
    $(function notificacion() {
                new PNotify({
                    title: "CORRECTO",
                    type: "success",
                    text: "{{ session('CORRECTO') }}",
                    styling: "bootstrap3"
                });
            });
</script>
@endif



@if (session('INCORRECTO'))
<script>
    $(function notificacion() {
                new PNotify({
                    title: "INCORRECTO",
                    type: "error",
                    text: "{{ session('INCORRECTO') }}",
                    styling: "bootstrap3"
                });
            });
</script>
@endif


<h4 class="text-center text-secondary">ACTUALIZAR PACIENTE</h4>

<div class="mb-0 col-12 bg-white p-5">
    @foreach ($sql as $item)
    <form action="{{ route('paciente.update') }}" method="POST">
        @csrf
        <div class="row">
            <input hidden name="id" type="text"value="{{ $item->id_paciente }}">
            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <input type="text" name="nombre" class="input input__text" id="nombre" placeholder="Nombre"
                    value="{{ $item->nombre }}">
                @error('nombre')
                <small class="error error__text">{{ $message }}</small>
                @enderror
            </div>
            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <input type="text" name="apellido" class="input input__text" id="apellido" placeholder="Apellido"
                    value="{{ $item->apellido }}">
                @error('apellido')
                <small class="error error__text">{{ $message }}</small>
                @enderror
            </div>
            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <input type="text" name="telefono" class="input input__text" placeholder="telefono *"
                    value="{{ old('telefono', $item->telefono) }}">

            </div>
            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <input type="text" name="direccion" class="input input__text" placeholder="direccion *"
                    value="{{ old('direccion', $item->direccion) }}">
            </div>

            @if ($item->genero=="Varon")
            <div class="form-check">
                <input class="form-check-input" type="radio" name="genero" id="v" value="Varon" checked>
                <label class="form-check-label" for="v">
                    Varón
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="genero" id="m" value="Mujer">
                <label class="form-check-label" for="m">
                    Mujer
                </label>
            </div>
            @error('genero')
                <small class="error error__text">{{ $message }}</small>
                @enderror
            @else
            <div class="form-check">
                <input class="form-check-input" type="radio" name="genero" id="v" value="Varon">
                <label class="form-check-label" for="v">
                    Varón
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="genero" id="m" value="Mujer" checked>
                <label class="form-check-label" for="m">
                    Mujer
                </label>
            </div>
            @error('genero')
                <small class="error error__text">{{ $message }}</small>
                @enderror

            @endif





            <div class="text-right mt-0">
                <a href="{{ route('paciente.index') }}" class="btn btn-rounded btn-secondary m-2">Atras</a>
                <button type="submit" class="btn btn-rounded btn-primary">Guardar</button>
            </div>
        </div>

    </form>
    @endforeach
</div>

@endsection
@endif