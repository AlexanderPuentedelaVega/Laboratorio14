<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $paciente=DB::select(" select count(*) as 'total' from paciente where estado=1 ");
        View::share('paciente', $paciente[0]->total);

        $doctor=DB::select(" select count(*) as 'total' from doctor where id_doctor=1 ");
        View::share('doctor', $doctor[0]->total);

        $especialidad=DB::select(" select count(*) as 'total' from especialidad where estado=1");
        View::share('especialidad', $especialidad[0]->total);

        $usuario=DB::select(" select count(*) as 'total' from usuario where estado=1 ");
        View::share('usuario', $usuario[0]->total);

        $cita=DB::select(" select count(*) as 'total' from cita where estado=0 ");
        View::share('cita', $cita[0]->total);
    }
}
