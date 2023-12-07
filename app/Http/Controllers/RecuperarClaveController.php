<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecuperarClaveRequest;
use App\Mail\RecuperarClaveMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RecuperarClaveController extends Controller
{
    public function index()
    {
        return view("auth/passwords.reset");
    }
    public function update(Request $request)
    {
        $request->validate([
            "correo" => "required|exists:App\Models\usuario,correo"
        ]);

        $correo = new RecuperarClaveMailable($request->all()); //enviamos estos datos al MAILABLE
        Mail::to($request->correo)->send($correo); //CORREO DEL RECEPTOR
        //return "mensaje enviado";
        //return redirect()->route('email.index')->with("mensaje", $request["correo"]);
        return redirect()->back()->with("mensaje", $request["correo"]);
    }


    public function nuevoClave($correo)
    {
        return view("auth/passwords.nuevoPass", compact("correo"));
    }

    public function reset(RecuperarClaveRequest $request)
    {
        $clave1 = md5($request->clave1);
        $clave2 = md5($request->clave2);
        if ($clave1 != $clave2) {
            return back()->with("mensaje", "Las contraseñas no coinciden");
        }
        $claveE = md5($request->clave1);
        try {
            $sql = DB::update(" update usuario set password=? where correo=?", [
                $claveE,
                $request->correo
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == 1) {
            return back()->with("correcto", "Contraseña restablecida correctamente");
        } else {
            return back()->with("incorrecto", "error al restablecer la contraseña");
        }
    }
}
