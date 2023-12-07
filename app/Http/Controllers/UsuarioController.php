<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioActualizarRequest;
use App\Http\Requests\UsuarioCrearRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    public function index()
    {
        try {
            $sql = DB::select('SELECT
            *,
            tipo_usuario.tipo
            FROM
            usuario
            INNER JOIN tipo_usuario ON usuario.tipo_usuario = tipo_usuario.id_tipo where usuario.estado=1
            ');
        } catch (\Throwable $th) {
            //throw $th;
        }
        return view('vistas/usuario/usuario', compact("sql"));
    }

    public function create()
    {
        try {
            $sql = DB::select('SELECT * from tipo_usuario');
        } catch (\Throwable $th) {
            //throw $th;
        }
        return view('vistas/usuario/registrar', compact('sql'));
    }

    public function store(UsuarioCrearRequest $request)
    {
        try {
            $sql = DB::insert('insert into usuario (tipo_usuario,nombre,apellido,usuario,password,correo,estado) values (?,?,?,?,?,?,1)', [
                $request->tipo,
                $request->nombre,
                $request->apellido,
                $request->usuario,
                md5($request->password),
                $request->correo
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == 1) {
            return back()->with('CORRECTO', 'Datos registrados correctamente');
        } else {
            return back()->with('INCORRECTO', 'Error al registrar');
        }
    }

    public function edit($id)
    {
        try {
            $sql = DB::select('select * from usuario where id_usuario=?', [
                $id
            ]);
            $tipoUsuario = DB::select("select * from tipo_usuario");
        } catch (\Throwable $th) {
            $sql = 0;
        }

        return view('vistas/usuario/actualizar', compact('sql'))->with('tipoUsuario', $tipoUsuario);
    }
    public function update(UsuarioActualizarRequest $request)
    {
        try {
            $sql = DB::update('update usuario set tipo_usuario=?, nombre=?, apellido=?, usuario=?, correo=? where id_usuario=?', [
                $request->tipo,
                $request->nombre,
                $request->apellido,
                $request->usuario,
                $request->correo,
                $request->id
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == 1) {
            return back()->with('CORRECTO', 'Datos modificados correctamente');
        } else {
            return back()->with('INCORRECTO', 'Error al modificar');
        }
    }
    public function destroy($id)
    {
        try {
            $sql2 = DB::delete("delete from cita where usuario=$id");
            $sql = DB::delete("delete from usuario where id_usuario=$id");
            if ($sql == 0) {
                $sql = 1;
            }
            if ($sql2 == 0) {
                $sql2 = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
            $sql2 = 0;
        }
        if ($sql2 == 1 and $sql == 1) {
            return back()->with('CORRECTO', 'Datos eliminados correctamente');
        } else {
            return back()->with('INCORRECTO', 'Error al eliminar');
        }
    }

    public function cambiar()
    {
        return view('vistas/cambiarClave');
    }

    public function cambiarClave(Request $request)
    {

        $request->validate([
            "claveActual" => "required",
            "claveNuevo" => "required",
        ]);

        $id = Auth::user()->id_usuario;
        $verClaveAn = DB::select(" select password from usuario where id_usuario=$id ");
        $pass = md5($request->claveNuevo);

        if ($verClaveAn[0]->password != md5($request->claveActual)) {
            return back()->with("AVISO", "La contraseña actual es INCORRECTA");
        }
        try {
            $sql = DB::update(" update usuario set password=? where id_usuario=? ", [
                $pass,
                $id
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == 1) {
            return back()->with("CORRECTO", "Contraseña modificado correctamente");
        } else {
            return back()->with("INCORRECTO", "Error al modificar");
        }
    }

    public function perfil()
    {
        $id = Auth::user()->id_usuario;
        $sql = DB::select("select * from usuario where id_usuario=$id");
        return view('vistas/perfilUsuario',compact("sql"));
    }

    public function cambiarPerfil(Request $request)
    {
        $id = Auth::user()->id_usuario;
        try {
            $sql = DB::update('update usuario set nombre=?, apellido=?, usuario=?, correo=? where id_usuario=?', [
                $request->nombre,
                $request->apellido,
                $request->usuario,
                $request->correo,
                $id
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == 1) {
            return back()->with('CORRECTO', 'Datos modificados correctamente');
        } else {
            return back()->with('INCORRECTO', 'Error al modificar');
        }
    }
}
