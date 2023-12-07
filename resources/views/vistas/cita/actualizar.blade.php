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


<h4 class="text-center text-secondary">ACTUALIZAR CITA</h4>

<div class="mb-0 col-12 bg-white p-5">

    <h5 class="text-center bg-light p-2">Datos del cliente o paciente</h5>
    @foreach ($sql as $item)
    <form action="{{ route('cita.update') }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="row">
            <input hidden type="text" value="{{$item->id_paciente}}" name="idpac">
            <input hidden type="text" value="{{$item->id_cita}}" name="idcita">
            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <input type="text" name="nombre" class="input input__text" id="nombre" placeholder="Nombre *"
                    value="{{ old('nombre',$item->nompac) }}">
                @error('nombre')
                <small class="error error__text">{{ $message }}</small>
                @enderror
            </div>
            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <input type="text" name="apellido" class="input input__text" id="apellido" placeholder="Apellido *"
                    value="{{ old('apellido',$item->apepac) }}">
                @error('apellido')
                <small class="error error__text">{{ $message }}</small>
                @enderror
            </div>



            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <input type="text" name="telefono" class="input input__text" placeholder="telefono"
                    value="{{ old('telefono',$item->telpac) }}">

            </div>

            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <input type="text" name="direccion" class="input input__text" placeholder="direccion"
                    value="{{ old('direccion',$item->direccion) }}">

            </div>
            <div class="col-12 col-lg-6 radio">

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
            </div>
        </div>


        <h5 class="text-center bg-light p-2">Datos de la cita</h5>

        <div class="row">
            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <select class="input input__select" name="doctor">
                    @foreach ($sql2 as $item2)
                    <option {{$item->id_doctor ==$item2->id_doctor ? 'selected' : '' }} value="{{
                        $item2->id_doctor }}">
                        {{ $item2->nombre }} {{ $item2->apellido }} - ({{ $item2->cargo }})</option>
                    @endforeach
                </select>
                @error('doctor')
                <small class="error error__text">{{ $message }}</small>
                @enderror
            </div>

            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <input type="text" name="asunto" class="input input__text" id="asunto" placeholder="Asunto *"
                    value="{{ old('asunto',$item->asunto) }}">
                @error('asunto')
                <small class="error error__text">{{ $message }}</small>
                @enderror
            </div>

            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <label>Fecha reserva</label>
                <input type="date" name="fecha_reserva" class="input input__text" id="fecha_reserva"
                    value="{{ old('fecha_reserva',$item->fecha_reserva) }}">
                @error('fecha_reserva')
                <small class="error error__text">{{ $message }}</small>
                @enderror
            </div>
            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <label>Fecha cita</label>
                <input type="date" name="fecha_cita" class="input input__text" id="fecha_cita"
                    value="{{ old('fecha_cita',$item->fecha_cita) }}">
                @error('fecha_cita')
                <small class="error error__text">{{ $message }}</small>
                @enderror
            </div>



            <div class="fl-flex-label mb-4 col-12">
                <input type="text" name="comentario" class="input input__text" placeholder="comentario *"
                    value="{{ old('comentario',$item->comentario) }}">
                @error('comentario')
                <small class="error error__text">{{ $message }}</small>
                @enderror
            </div>

            <div class="text-right mt-0">
                <a href="{{ route('cita.index') }}" class="btn btn-rounded btn-secondary m-2">Atras</a>
                <button type="submit" class="btn btn-rounded btn-primary">Guardar</button>
            </div>
        </div>

    </form>
    @endforeach
</div>

@endsection