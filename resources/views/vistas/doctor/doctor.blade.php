@if (Auth::user()->tipo_usuario==1)
@extends('layouts/app')
@section('titulo', 'lista de medicos')
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

    <h4 class="text-center text-secondary">LISTA DE MEDICOS</h4>
    <div class="pb-1 pt-2">
        <a href="{{ route('medico.create') }}" class="btn btn-rounded btn-primary"><i class="fas fa-plus"></i>&nbsp;
            Registrar</a>
    </div>


    <section class="card">
        <div class="card-block">
            <table id="example" class="display table table-striped" cellspacing="0" width="100%">
                <thead class="table-primary">
                    <tr>
                        <th>id</th>
                        <th>Nombres</th>
                        <th>Cargo</th>
                        <th>Teléfono</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($sql as $item)
                        <tr>
                            <td>{{ $item->id_doctor }}</td>
                            <td>{{ $item->nombre }} {{ $item->apellido }}</td>
                            <td>{{ $item->cargo }}</td>
                            <td>{{ $item->telefono }}</td>
                            
                            <td>

                                <a style="top: 0" href="{{ route('medico.edit', $item->id_doctor) }}"
                                    class="btn btn-sm btn-warning m-1"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('medico.destroy', $item->id_doctor) }}" method="get"
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
