@if (Auth::user()->tipo_usuario==1)
@extends('layouts/app')
@section('titulo', 'Actualizar especialidad')
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

    


    <h4 class="text-center text-secondary">ACTUALIZAR ESPECIALIDAD</h4>

    <div class="mb-0 col-12 bg-white p-5">
        @foreach ($sql as $item)
            <form action="{{ route('especialidad.update', $item->id_especialidad) }}" method="POST">
                @csrf
                <div class="row">
                    <input hidden type="text" name="id" value="{{ $item->id_especialidad }}">

                    <div class="fl-flex-label mb-4 col-12">
                        <input type="text" name="nombre" class="input input__text" id="nombre" placeholder="Nombre"
                            value="{{ $item->cargo }}">
                    </div>

                    <div class="text-right mt-0">
                        <a href="{{ route('especialidad.index') }}" class="btn btn-rounded btn-secondary m-2">Atras</a>
                        <button type="submit" class="btn btn-rounded btn-primary">Guardar</button>
                    </div>
                </div>

            </form>
        @endforeach
    </div>

@endsection
@endif
