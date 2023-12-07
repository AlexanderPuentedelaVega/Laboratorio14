@if (Auth::user()->tipo_usuario==1)
@extends('layouts/app')
@section('titulo', 'Registrar especialidad')
@section('content')
    {{-- notificaciones --}}


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


    <h4 class="text-center text-secondary">REGISTRO DE ESPECIALIDAD</h4>

    <div class="mb-0 col-12 bg-white p-5">
        <form action="{{ route('especialidad.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="row">
                
                <div class="fl-flex-label mb-4 col-12">
                    <input type="text" name="nombre" class="input input__text" id="nombre" placeholder="Nombre"
                        value="{{ old('nombre') }}">
                    @error('nombre')
                        <small class="error error__text">{{ $message }}</small>
                    @enderror
                </div>
                
                <div class="text-right mt-0">
                    <a href="{{ route('especialidad.index') }}" class="btn btn-rounded btn-secondary m-2">Atras</a>
                    <button type="submit" class="btn btn-rounded btn-primary">Guardar</button>
                </div>
            </div>

        </form>
    </div>
@endsection
@endif