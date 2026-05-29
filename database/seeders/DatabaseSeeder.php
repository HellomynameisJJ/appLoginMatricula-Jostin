<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── ALUMNOS ────────────────────────────────────────────────────
        $alumnos = [
            ['nombre'=>'Carlos',    'apellidos'=>'Quispe Mamani',    'fecha_nacimiento'=>'2001-03-15', 'dni'=>'71234501', 'direccion'=>'Av. Túpac Amaru 120',   'telefono'=>'987001001', 'email'=>'carlos.quispe@uni.edu.pe',    'estado_matricula'=>'matriculado'],
            ['nombre'=>'Lucía',     'apellidos'=>'Flores Huanca',    'fecha_nacimiento'=>'2002-07-22', 'dni'=>'71234502', 'direccion'=>'Jr. Lima 345',           'telefono'=>'987001002', 'email'=>'lucia.flores@uni.edu.pe',     'estado_matricula'=>'matriculado'],
            ['nombre'=>'Miguel',    'apellidos'=>'Torres Ccallo',    'fecha_nacimiento'=>'2000-11-08', 'dni'=>'71234503', 'direccion'=>'Calle Real 89',          'telefono'=>'987001003', 'email'=>'miguel.torres@uni.edu.pe',    'estado_matricula'=>'matriculado'],
            ['nombre'=>'Valentina', 'apellidos'=>'Chávez Apaza',     'fecha_nacimiento'=>'2003-01-30', 'dni'=>'71234504', 'direccion'=>'Av. Grau 456',           'telefono'=>'987001004', 'email'=>'valentina.chavez@uni.edu.pe', 'estado_matricula'=>'inactivo'],
            ['nombre'=>'Diego',     'apellidos'=>'Ramos Condori',    'fecha_nacimiento'=>'2001-05-12', 'dni'=>'71234505', 'direccion'=>'Jr. Tacna 210',          'telefono'=>'987001005', 'email'=>'diego.ramos@uni.edu.pe',      'estado_matricula'=>'matriculado'],
            ['nombre'=>'Adriana',   'apellidos'=>'Mendoza Pilco',    'fecha_nacimiento'=>'2002-09-04', 'dni'=>'71234506', 'direccion'=>'Av. Arequipa 780',       'telefono'=>'987001006', 'email'=>'adriana.mendoza@uni.edu.pe',  'estado_matricula'=>'matriculado'],
            ['nombre'=>'Sebastián', 'apellidos'=>'Vargas Ticona',    'fecha_nacimiento'=>'2000-12-19', 'dni'=>'71234507', 'direccion'=>'Urb. Los Pinos 34',      'telefono'=>'987001007', 'email'=>'sebastian.vargas@uni.edu.pe', 'estado_matricula'=>'matriculado'],
            ['nombre'=>'Camila',    'apellidos'=>'Paredes Huayhua',  'fecha_nacimiento'=>'2003-04-27', 'dni'=>'71234508', 'direccion'=>'Jr. Ucayali 99',         'telefono'=>'987001008', 'email'=>'camila.paredes@uni.edu.pe',   'estado_matricula'=>'inactivo'],
            ['nombre'=>'Rodrigo',   'apellidos'=>'Soto Lazo',        'fecha_nacimiento'=>'2001-08-16', 'dni'=>'71234509', 'direccion'=>'Av. Colonial 555',       'telefono'=>'987001009', 'email'=>'rodrigo.soto@uni.edu.pe',     'estado_matricula'=>'matriculado'],
            ['nombre'=>'Fernanda',  'apellidos'=>'Castillo Inca',    'fecha_nacimiento'=>'2002-02-03', 'dni'=>'71234510', 'direccion'=>'Pasaje Rosario 12',      'telefono'=>'987001010', 'email'=>'fernanda.castillo@uni.edu.pe','estado_matricula'=>'matriculado'],
        ];

        foreach ($alumnos as $a) {
            DB::table('alumnos')->insert(array_merge($a, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]));
        }

        // ── PROFESORES ────────────────────────────────────────────────
        $profesores = [
            ['nombre'=>'Jorge',    'apellidos'=>'Gutiérrez López',  'especialidad'=>'Ingeniería de Software'],
            ['nombre'=>'Patricia', 'apellidos'=>'Morales Díaz',     'especialidad'=>'Base de Datos'],
            ['nombre'=>'Raúl',     'apellidos'=>'Benítez Castro',   'especialidad'=>'Redes y Comunicaciones'],
            ['nombre'=>'Sandra',   'apellidos'=>'Vega Ponce',       'especialidad'=>'Inteligencia Artificial'],
            ['nombre'=>'Luis',     'apellidos'=>'Herrera Mamani',   'especialidad'=>'Ciberseguridad'],
            ['nombre'=>'Elena',    'apellidos'=>'Campos Quispe',    'especialidad'=>'Desarrollo Web'],
            ['nombre'=>'Marco',    'apellidos'=>'Fuentes Rosas',    'especialidad'=>'Sistemas Operativos'],
            ['nombre'=>'Diana',    'apellidos'=>'Zapata Torres',    'especialidad'=>'Algoritmos y Estructura de Datos'],
            ['nombre'=>'Andrés',   'apellidos'=>'Reyes Condori',    'especialidad'=>'Cloud Computing'],
            ['nombre'=>'Mónica',   'apellidos'=>'Salas Flores',     'especialidad'=>'Ingeniería de Requisitos'],
        ];

        foreach ($profesores as $p) {
            DB::table('profesores')->insert(array_merge($p, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]));
        }

        // ── CURSOS ────────────────────────────────────────────────────
        $cursos = [
            ['nombre_curso'=>'Programación Web I',          'codigo_curso'=>'PW101', 'creditos'=>4, 'descripcion'=>'Fundamentos de HTML, CSS y JavaScript.'],
            ['nombre_curso'=>'Base de Datos I',             'codigo_curso'=>'BD101', 'creditos'=>4, 'descripcion'=>'Modelado relacional y SQL.'],
            ['nombre_curso'=>'Algoritmos',                  'codigo_curso'=>'AL101', 'creditos'=>3, 'descripcion'=>'Diseño y análisis de algoritmos.'],
            ['nombre_curso'=>'Redes de Computadoras',       'codigo_curso'=>'RC101', 'creditos'=>3, 'descripcion'=>'Protocolos TCP/IP y arquitectura de redes.'],
            ['nombre_curso'=>'Sistemas Operativos',         'codigo_curso'=>'SO101', 'creditos'=>3, 'descripcion'=>'Gestión de procesos, memoria y archivos.'],
            ['nombre_curso'=>'Ingeniería de Software',      'codigo_curso'=>'IS101', 'creditos'=>4, 'descripcion'=>'Metodologías ágiles y ciclo de vida del software.'],
            ['nombre_curso'=>'Inteligencia Artificial',     'codigo_curso'=>'IA101', 'creditos'=>4, 'descripcion'=>'Machine learning y procesamiento de lenguaje natural.'],
            ['nombre_curso'=>'Ciberseguridad',              'codigo_curso'=>'CS101', 'creditos'=>3, 'descripcion'=>'Seguridad en aplicaciones y redes.'],
            ['nombre_curso'=>'Cloud Computing',             'codigo_curso'=>'CC101', 'creditos'=>3, 'descripcion'=>'AWS, Azure y GCP para despliegue de aplicaciones.'],
            ['nombre_curso'=>'Programación Backend',        'codigo_curso'=>'PB101', 'creditos'=>4, 'descripcion'=>'Laravel, Node.js y APIs RESTful.'],
        ];

        foreach ($cursos as $c) {
            DB::table('cursos')->insert(array_merge($c, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]));
        }

        // ── HORARIOS ─────────────────────────────────────────────────
        $dias = ['Lunes','Martes','Miércoles','Jueves','Viernes'];
        for ($i = 1; $i <= 10; $i++) {
            DB::table('horarios')->insert([
                'id_curso'    => $i,
                'dia_semana'  => $dias[($i - 1) % 5],
                'hora_inicio' => sprintf('%02d:00:00', 7 + $i),
                'hora_fin'    => sprintf('%02d:00:00', 9 + $i),
                'id_aula'     => 'AULA-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ]);
        }

        // ── MATRÍCULAS ────────────────────────────────────────────────
        $estados = ['aprobado', 'reprobado', 'cursando'];
        for ($i = 1; $i <= 10; $i++) {
            DB::table('matriculas')->insert([
                'id_alumno'      => $i,
                'id_curso'       => $i,
                'id_profesor'    => $i,
                'id_horario'     => $i,
                'semestre'       => '2025-I',
                'fecha_matricula'=> Carbon::now()->subDays(rand(10, 90))->toDateString(),
                'nota_final'     => $i <= 7 ? rand(11, 20) : null,
                'estado'         => $estados[($i - 1) % 3],
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ]);
        }
    }
}