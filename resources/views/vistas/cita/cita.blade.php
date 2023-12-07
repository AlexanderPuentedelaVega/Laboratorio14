@extends('layouts/app')
@section('titulo', 'lista de CITAS')
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

<h4 class="text-center text-secondary">LISTA DE CITAS</h4>
<div class="pb-1 pt-2">
    <a href="{{ route('cita.create') }}" class="btn btn-rounded btn-primary"><i class="fas fa-plus"></i>&nbsp;
        Registrar</a>
</div>


<section class="card">
    <div class="card-block">
        <table id="example" class="display table table-striped" cellspacing="0" width="100%">
            <thead class="table-primary">
                <tr>
                    <th>id</th>
                    <th>Paciente</th>
                    <th>Asunto</th>
                    <th>Doctor</th>
                    <th>F-Reserva</th>
                    <th>F-Cita</th>
                    <th>Comentario</th>
                    <th>Estado</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($sql as $item)
                <tr>
                    <td>{{ $item->id_cita }}</td>
                    <td>{{ $item->nompac }} {{ $item->apepac }}</td>
                    <td>{{ $item->asunto }}</td>
                    <td>{{ $item->nomdoc }} {{ $item->apedoc }}</td>
                    <td>{{ $item->fecha_reserva }}</td>
                    <td>{{ $item->fecha_cita }}</td>
                    <td>{{ $item->comentario }}</td>
                    <td>
                        @if ($item->estado==1)
                        <a href="{{ route('cita.procesarCita', $item->id_cita) }}"
                            class="p-2 font-weight-bold bg-success" title="Click para cambiar estado"><i
                                class="fas fa-check"></i>
                            Procesado</a>
                        @else
                        <a href="{{ route('cita.procesarCita', $item->id_cita) }}"
                            class="p-2 font-weight-bold bg-danger" title="Click para cambiar estado"><i
                                class="fas fa-times"></i>
                            Pendiente</a>
                        @endif
                    </td>

                    <td>

                        <a style="top: 0"
                            href="{{ route('cita.edit', [$item->id_cita ,$item->id_doctor,$item->id_paciente,$item->id_usuario]) }}"
                            class="btn btn-sm btn-warning m-1"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('cita.destroy', $item->id_cita) }}" method="get"
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