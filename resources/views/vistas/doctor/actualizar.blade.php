@if (Auth::user()->tipo_usuario==1)
@extends('layouts/app')
@section('titulo', 'Actualizar medico')
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


<h4 class="text-center text-secondary">ACTUALIZAR MEDICO</h4>

<div class="mb-0 col-12 bg-white p-5">
    @foreach ($sql as $item)
    <form action="{{ route('medico.update', $item->id_doctor) }}" method="POST">
        @csrf
        <div class="row">
            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <input hidden type="text" name="id" value="{{ $item->id_doctor }}">
                <select class="input input__select" name="cargo">
                    <option value="">Seleccionar cargo de medico...</option>
                    @foreach ($sql2 as $item2)
                    <option {{ $item->area == $item2->id_especialidad ? 'selected' : '' }}
                        value="{{ $item2->id_especialidad }}">
                        {{ $item2->cargo }}</option>
                    @endforeach
                </select>
                @error('cargo')
                <small class="error error__text">{{ $message }}</small>
                @enderror
            </div>

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
            </div>
            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <input type="text" name="telefono" class="input input__text" placeholder="telefono *"
                    value="{{ old('telefono', $item->telefono) }}">
                @error('telefono')
                <small class="error error__text">{{ $message }}</small>
                @enderror
            </div>





            <div class="text-right mt-0">
                <a href="{{ route('medico.index') }}" class="btn btn-rounded btn-secondary m-2">Atras</a>
                <button type="submit" class="btn btn-rounded btn-primary">Guardar</button>
            </div>
        </div>

    </form>
    @endforeach
</div>

@endsection

@endif