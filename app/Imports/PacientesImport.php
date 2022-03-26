<?php

namespace App\Imports;

use App\Models\Pacientes2;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
//use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;

class PacientesImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function collection(Collection $rows)
    {
        $array = array();

        foreach ($rows as $index => $row) 
        {

            if($row[1]!=null && $index>0 /*&& array_key_exists('1', $row)*/){
                $fecha = (string) $row[0];
                $dni = (string) $row[1];
                $nombres = (string) $row[2];
                $grupoderiesgo = (string) $row[3];
                $edad = (string) $row[4];
                $dosis = (int) $row[5];
                $marca = (string) $row[6];
                $lote = (string) $row[7];
                $horaregistro = (string) $row[8];
                $admision_nombre = (string) $row[9];
                $modulo_admision = (string) $row[10];

                $horatriaje = (string) $row[11];
                $triaje = (string) $row[12];
                //$horavacunacion = (string) $row[13];
                //$enfvacunacion = (string) $row[14]; //licenciado

                if(strlen($dni)==7){
                    $dni = '0' . $dni;
                }
/*
                if($edad == ''|| !is_numeric($edad) || is_null($edad)){
                    dd($fecha);
                }*/
                if($dosis!='' && $dosis!=0){
                    $paciente = Pacientes2::updateOrCreate(array('dni' => $dni,'fecha'=>$fecha));
                    $paciente->dni = $dni;
                    $paciente->fecha = $fecha;
                    $paciente->nombres = $nombres;
                    $paciente->grupoderiesgo = $grupoderiesgo;
                    $paciente->edad = $edad;
                    $paciente->dosis = $dosis;
                    $paciente->marca = $marca;
                    $paciente->lote = $lote;
                    $paciente->horaregistro = $horaregistro;
                    $paciente->admision_nombre = $admision_nombre;  //DOGOTADOR DE ADMISION
                    $paciente->modulo_admision = $modulo_admision;
                    $paciente->establecimiento_id = 6;


                    $paciente->horatriaje = $horatriaje;
                    $paciente->triaje = $triaje;
                    //$paciente->horavacunacion = $horavacunacion;
                    //$paciente->licenciado = $enfvacunacion;

                    $result = $paciente->save();
                    /*$array[]['result'] = $paciente->get();
                    if($user->save()){
                        $student = Student::updateOrCreate(array('user_id'=>$user->id));
                        $student->user_id=$user->id;
                        $student->code=$code;
                        $student->father_dni=$father_dni;
                        $student->mother_dni=$mother_dni;
                        if($student->save()){

                            Student_level::create([
                                'student_id'=>$student->id,
                                'class_id'=>$room,
                                'year'=>date('Y')
                            ]);
                        }
                    }*/
                }
                    
                
            }
           
        }
    }
}