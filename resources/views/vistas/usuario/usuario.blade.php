@if (Auth::user()->tipo_usuario==1)
@extends('layouts/app')
@section('titulo', 'lista de usuarios')
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

    <h4 class="text-center text-secondary">LISTA DE USUARIOS</h4>
    <div class="pb-1 pt-2">
        <a href="{{ route('usuario.create') }}" class="btn btn-rounded btn-primary"><i class="fas fa-plus"></i>&nbsp;
            Registrar</a>
    </div>


    <section class="card">
        <div class="card-block">
            <table id="example" class="display table table-striped" cellspacing="0" width="100%">
                <thead class="table-primary">
                    <tr>
                        <th>id</th>
                        <th>Tipo</th>
                        <th>Nombres</th>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($sql as $item)
                        <tr>
                            <td>{{ $item->id_usuario }}</td>
                            <td>{{ $item->tipo }}</td>
                            <td>{{ $item->nombre }} {{ $item->apellido }}</td>
                            <td>{{ $item->usuario }}</td>
                            <td>{{ $item->correo }}</td>
                            
                            <td>

                                <a style="top: 0" href="{{ route('usuario.edit', $item->id_usuario) }}"
                                    class="btn btn-sm btn-warning m-1"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('usuario.destroy', $item->id_usuario) }}" method="get"
                                    class="d-inline formulario-eliminar">
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>

                            
                            <!--.modal-->
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

@endsection
@endif