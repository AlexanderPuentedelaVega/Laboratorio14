@extends('layouts/app')
@section('titulo', "info empresa")

@section('content')

<style>
    img.logo {
        width: 130px;
        height: 130px;
        border-radius: 50%;
        box-shadow: 0px 0px 20px rgb(226, 226, 226);
        margin-top: -20px;
        margin-bottom: 40px;
        object-fit: cover;
    }

    .logo {
        font-size: 130px;
        color: rgb(228, 228, 228);
    }

    .img {
        background: rgb(247, 251, 255);
    }
</style>

{{-- notificaciones --}}


@if (session('CORRECTO'))
<script>
    $(function notificacion(){
    new PNotify({
        title:"CORRECTO",
        type:"success",
        text:"{{session('CORRECTO')}}",
        styling:"bootstrap3"
    });		
});
</script>
@endif



@if (session('INCORRECTO'))
<script>
    $(function notificacion(){
    new PNotify({
        title:"INCORRECTO",
        type:"error",
        text:"{{session('INCORRECTO')}}",
        styling:"bootstrap3"
    });		
});
</script>
@endif

@if (session('AVISO'))
<script>
    $(function notificacion(){
    new PNotify({
        title:"AVISO",
        type:"error",
        text:"{{session('AVISO')}}",
        styling:"bootstrap3"
    });		
});
</script>
@endif


<h4 class="text-center text-secondary">MI PERFIL</h4>

<div class="mb-0 col-12 bg-white p-5">
    @foreach ($sql as $item)
        <form action="{{ route('usuario.cambiarPerfil') }}" method="POST">
            @csrf
            <div class="row">               

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
                    <input type="text" name="usuario" class="input input__text" placeholder="Usuario *"
                        value="{{ old('usuario', $item->usuario) }}">
                    @error('usuario')
                        <small class="error error__text">{{ $message }}</small>
                    @enderror
                </div>



                <div class="fl-flex-label mb-4 col-12 col-lg-6">
                    <input type="email" name="correo" class="input input__text" placeholder="Correo *"
                        value="{{ old('correo', $item->correo) }}">
                    @error('correo')
                        <small class="error error__text">{{ $message }}</small>
                    @enderror
                </div>

                <div class="text-right mt-0">
                    <button type="submit" class="btn btn-rounded btn-primary">Guardar</button>
                </div>
            </div>

        </form>
    @endforeach
</div>




@endsection