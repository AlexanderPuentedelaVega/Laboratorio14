<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CitaController extends Controller
{
    public function index()
    {
        try {
            $sql = DB::select("
            SELECT
cita.id_cita,
cita.asunto,
cita.fecha_reserva,
cita.fecha_cita,
cita.comentario,
cita.estado,
doctor.id_doctor,
doctor.nombre as 'nomdoc',
doctor.apellido as 'apedoc',
doctor.telefono,
paciente.id_paciente,
paciente.nombre as 'nompac',
paciente.apellido as 'apepac',
paciente.telefono  as 'telpac',
paciente.direccion,
paciente.genero,
usuario.id_usuario,
usuario.nombre,
usuario.apellido
FROM
cita
INNER JOIN doctor ON cita.doctor = doctor.id_doctor
INNER JOIN paciente ON cita.paciente = paciente.id_paciente
INNER JOIN usuario ON cita.usuario = usuario.id_usuario

                ");
        } catch (\Throwable $th) {
            //throw $th;
        }
        return view('vistas/cita/cita', compact("sql"));
    }

    public function create()
    {
        try {
            $sql = DB::select('SELECT
            doctor.*,
            especialidad.*
            FROM
            doctor
            INNER JOIN especialidad ON doctor.area = especialidad.id_especialidad
             where doctor.estado=1');
        } catch (\Throwable $th) {
            //throw $th;
        }
        return view('vistas/cita/registrar', compact('sql'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required'],
            'apellido' => ['required'],
            'doctor' => ['required'],
            'asunto' => ['required'],
            'fecha_reserva' => ['required'],
            'fecha_cita' => ['required']
        ]);
        try {
            $sql = DB::insert('insert into paciente (nombre,apellido,telefono,direccion,genero,estado) values (?,?,?,?,?,1)', [
                $request->nombre,
                $request->apellido,
                $request->telefono,
                $request->direccion,
                $request->genero
            ]);

            $buscarUltCli = DB::select("select max(id_paciente) as 'total' from paciente");
            $idUltCli = $buscarUltCli[0]->total;
            $idUser = Auth::user()->id_usuario;

            $sql2 = DB::insert('insert into cita (usuario,paciente,doctor,asunto,fecha_reserva,fecha_cita,comentario,estado) values (?,?,?,?,?,?,?,0)', [
                $idUser,
                $idUltCli,
                $request->doctor,
                $request->asunto,
                $request->fecha_reserva,
                $request->fecha_cita,
                $request->comentario

            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == 1 and $sql2 == 1) {
            return back()->with('CORRECTO', 'Datos registrados correctamente');
        } else {
            return back()->with('INCORRECTO', 'Error al registrar');
        }
    }

    public function edit($id, $id2, $id3, $id4)
    {
        try {
            $sql = DB::select("SELECT
            cita.id_cita,
            cita.asunto,
            cita.fecha_reserva,
            cita.fecha_cita,
            cita.comentario,
            cita.estado,
            doctor.id_doctor,
            doctor.nombre as 'nomdoc',
            doctor.apellido as 'apedoc',
            doctor.telefono,
            paciente.id_paciente,
            paciente.nombre as 'nompac',
            paciente.apellido as 'apepac',
            paciente.telefono  as 'telpac',
            paciente.direccion,
            paciente.genero,
            usuario.id_usuario,
            usuario.nombre,
            usuario.apellido
            FROM
            cita
            INNER JOIN doctor ON cita.doctor = doctor.id_doctor
            INNER JOIN paciente ON cita.paciente = paciente.id_paciente
            INNER JOIN usuario ON cita.usuario = usuario.id_usuario
            where id_cita=$id");

            $sql2 = DB::select("SELECT
            doctor.*,
            especialidad.*
            FROM
            doctor
            INNER JOIN especialidad ON doctor.area = especialidad.id_especialidad");
            $sql3 = DB::select("select * from paciente where id_paciente=$id3");
            $sql4 = DB::select("select * from usuario where id_usuario=$id4");
        } catch (\Throwable $th) {
            //throw $th;
        }
        return view('vistas/cita/actualizar', compact('sql'))->with("sql2", $sql2)->with("sql3", $sql3)->with("sql4", $sql4);
    }
    public function update(Request $request)
    {
        $request->validate([
            'nombre' => ['required'],
            'apellido' => ['required'],
            'doctor' => ['required'],
            'asunto' => ['required'],
            'fecha_reserva' => ['required'],
            'fecha_cita' => ['required']
        ]);
        $idUser = Auth::user()->id_usuario;
        try {
            $sql = DB::update('update paciente set nombre=?, apellido=?, telefono=?, direccion=?, genero=? where id_paciente=?', [
                $request->nombre,
                $request->apellido,
                $request->telefono,
                $request->direccion,
                $request->genero,
                $request->idpac
            ]);
            if ($sql == 0) {
                $sql = 1;
            }

            $sql2 = DB::update('update cita set usuario=?, paciente=?, doctor=?, asunto=?, fecha_reserva=?, fecha_cita=?, comentario=? where id_cita=?', [
                $idUser,
                $request->idpac,
                $request->doctor,
                $request->asunto,
                $request->fecha_reserva,
                $request->fecha_cita,
                $request->comentario,
                $request->idcita
            ]);
            if ($sql2 == 0) {
                $sql2 = 1;
            }
        } catch (\Throwable $th) {
            $sql2 = 0;
        }
        if ($sql == 1 and $sql2 == 1) {
            return back()->with('CORRECTO', 'Datos modificados correctamente');
        } else {
            return back()->with('INCORRECTO', 'Error al modificar');
        }
    }
    public function destroy($id)
    {
        try {
            $sql = DB::delete("delete from cita where id_cita=$id");
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == 1) {
            return back()->with('CORRECTO', 'Datos eliminados correctamente');
        } else {
            return back()->with('INCORRECTO', 'Error al eliminar');
        }
    }

    public function procesarCita($id)
    {
        try {
            $sql = DB::update("update cita set estado=!estado where id_cita=$id");
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == 1) {
            return back()->with('CORRECTO', 'Cambios realizados correctamente');
        } else {
            return back()->with('INCORRECTO', 'Error al realizar cambios');
        }
    }
}
