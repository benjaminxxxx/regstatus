<?php

namespace App\Exports;

use App\Models\UsuarioAtendido;
use App\Models\Establecimiento;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsuarioAtendidoTable implements FromCollection,WithColumnWidths,WithTitle,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $vars;

    function __construct($vars=[]) {
        $this->vars = $vars;
        
    }
    
    public function title(): string
    {
        return 'Usuarios Atendidos';
    }
    public function styles(Worksheet $sheet)
    {
        //$sheet->setBorder('A1', 'thin');
        $maxrow = $sheet->getHighestRow();
        $lastcell = 'T';
        
        $sheet->mergeCells("A1:".$lastcell."1");
        $sheet->getStyle("A2:".$lastcell.$maxrow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000']
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        $sheet->getStyle("A2:".$lastcell."2")->applyFromArray([
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['argb' => '5B9BD5']
            ]
        ]);
        $sheet->getStyle('C')->applyFromArray([
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
            ],
        ]);
        $sheet->getStyle('D')->applyFromArray([
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
            ],
        ]);
        $sheet->getStyle('A1:S1')->applyFromArray([
            'font' => [
                'bold' => false,
                'size'=>20,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ]);
    }

    public function headings(): array
    {
       
    }

    public function collection()
    {
        $response2 = $this->vars;
        $where = [];
        $allRecords = [];
        $response = [];

        $title = 'MATRIZ DE VACUNADOS';

        $from = '';

        if(isset($response2['digitador_dni'])){
            $where['digitador_dni']=$response2['digitador_dni'];
            $from.= ' DIGITADOR: ' . $response2['digitador_name'] . ' ';
        }

        if(isset($response2['vacunador_id'])){
            $where['vacunador_id']=$response2['vacunador_id'];
            $from.= ' VACUNADOR: ' . $response2['digitador_name'] . ' ';
        }

        $title.=$from;
        
        if(isset($response2['establecimiento_id'])){
            $where['establecimiento_id']=$response2['establecimiento_id'];
        }

        if(isset($response2['licenciado'])){
            $where['licenciado']=$response2['licenciado'];
            $title = 'MATRIZ DE VACUNADOS ' . mb_strtoupper($response2['licenciado']);
        }

        if(isset($response2['riesgo'])){
            $where['grupoderiesgo']=$response2['riesgo'];
            $title = 'MATRIZ DE VACUNADOS ' . mb_strtoupper($response2['riesgo']);
        }

        if(isset($response2['dosis'])){
            $where['dosis']=$response2['dosis'];
            $title = 'MATRIZ DE VACUNADOS DOSIS' . mb_strtoupper($response2['dosis']);
        }

        if(isset($response2['estado'])){
            $where['estado']=$response2['estado'];
        }

        


        if(isset($response2['fecha']) && $response2['fecha']!=''){
            //filtro por fecha
            if(isset($response2['fechahasta']) && $response2['fechahasta']!=''){

                $from = date($response2['fecha']);
                $to = date($response2['fechahasta']);

                $title = 'MATRIZ DE VACUNADOS ' .$from. $response2['fecha'] . ' - ' . $response2['fechahasta'];

                $allRecords = UsuarioAtendido::whereBetween('fechahora', [$from, $to])->where($where)->orderBy('fechahora','desc')->get()->toArray();
                
            }else{
                $title = 'MATRIZ DE VACUNADOS ' .$from. mb_strtoupper($response2['fecha']);
                $allRecords = UsuarioAtendido::whereDate('fechahora','=',$response2['fecha'])->where($where)->orderBy('fechahora','desc')->get()->toArray();
            }
            
            
        }else{
            $allRecords = UsuarioAtendido::where($where)->orderBy('fechahora','desc')->get()->toArray();
        }
        
        
        $response[0] = [
            'dni'=>$title,
        ];
        $response[1] = ['FECHA','DNI','NOMBRES Y APELLIDOS','TELEFONO','GRUPO DE RIESGO','EDAD','DOSIS','MARCA','LOTE',
        'HORA DE REGISTRO','DIGITADOR DE ADMISIÓN','MÓDULO DE ADMISIÓN','HORA DE TRIAJE','ENF. TRIAJE',
        'HORA DE VACUNACIÓN','ENF. VACUNACIÓN','MÓDULO DE VACUNACIÓN','HORA DE SALIDA','DIGITADOR DE VACUNATORIO','LIC. MONITOREO'];
        if(count($allRecords)>0){
            foreach($allRecords as $key=>$record){

                //TRIAJE
                $key+=2;
                if($record['fechahora']!=null){
                    $response[$key]['fechahora'] = date('d-m-Y',strtotime($record['fechahora']));
                }else{
                    $response[$key]['fechahora'] = date('d-m-Y',strtotime($record['created_at']));
                }
                
                $response[$key]['dni'] = $record['documento'];
                $response[$key]['nombres'] = mb_strtoupper($record['nombres']);
                $response[$key]['telefono'] = $record['telefono'];
                $response[$key]['grupoderiesgo'] = $record['grupoderiesgo'];
               

                $response[$key]['edad'] = $record['edad'];
                $response[$key]['dosis'] = $record['dosis'];

                $response[$key]['marca'] = $record['marca'];
                $response[$key]['lote'] = $record['lote'];

                //$response[$key]['fecha_nacimiento'] = $record['fecha_nacimiento'];
                $response[$key]['horaregistro'] = $record['horaregistro'];
                $response[$key]['admision_nombre'] = $record['admision_nombre'];
                $response[$key]['modulo_admision'] = mb_strtoupper($record['modulo_admision']);
                $response[$key]['horatriaje'] = $record['horatriaje'];
                $response[$key]['triaje'] = mb_strtoupper($record['triaje']);
                if($record['fechahora']!=null && $record['fechahora']!=''){
                    $response[$key]['horavacunacion'] = date('g:i A',strtotime($record['fechahora']));
                }else{
                    $response[$key]['horavacunacion'] = '-';
                }
                
                $response[$key]['licenciado'] = mb_strtoupper($record['licenciado']);

                $response[$key]['modulo_vacunatorio'] = $record['modulo_vacunatorio'];
                $response[$key]['alta'] = mb_strtoupper($record['horaalta']);
                /*$response[$key]['lote'] = mb_strtoupper($record['lote']);
                $response[$key]['digitador_dni'] = $record['digitador_dni'];
                */
                $response[$key]['digitador'] = mb_strtoupper($record['digitador']);
                /*$response[$key]['modulo'] = $record['modulo'];

                $response[$key]['alta'] = $record['horaalta'];
                $response[$key]['estado'] = $record['estado'];
                $response[$key]['lector_dni'] = $record['lector_dni'];*/
                $response[$key]['lector'] = mb_strtoupper($record['lector']);

                
            }   
            
            
        }

        $response[] = [
            'dni'=>'______',
            'nombres'=>'______',
        ];

        $response[] = [
            'dni'=>'Total',
            'nombres'=>(string)count($allRecords),
        ];

        $response[] = [
            'dni'=>'Filtros:'
        ];
        if(isset($response2['establecimiento_id'])){
            $sede = Establecimiento::find($response2['establecimiento_id']);
            $esta = 'Sede eliminada';
            if($sede!=null){
                $esta = $sede->nombre;
            }
            $response[] = [
                'dni'=>'Sede:',
                'nombres'=>mb_strtoupper($esta),
            ];
        }

        if(isset($response2['licenciado'])){
            $response[] = [
                'dni'=>'Vacunador(a):',
                'nombres'=>$response2['licenciado'],
            ];
        }
        if(isset($response2['grupoderiesgo'])){
            $response[] = [
                'dni'=>'Grupo de Riesgo:',
                'nombres'=>$response2['grupoderiesgo'],
            ];
        }
        if(isset($response2['dosis'])){
            $response[] = [
                'dni'=>'Dosis:',
                'nombres'=>$response2['dosis'],
            ];
        }
        if(isset($response2['estado'])){
            $response[] = [
                'dni'=>'Estado:',
                'nombres'=>$response2['estado'],
            ];
        }
        if(isset($response2['fecha'])){
            $response[] = [
                'dni'=>'Fecha:',
                'nombres'=>$response2['fecha'],
            ];
        }
        return collect($response);
    }
    public function columnWidths(): array
    {
        return [
            'A' => 11,
            'B' => 11,
            'C' => 35,
            'D' => 11,
            'E' => 25,
            'F' => 9,
            'G' => 9,
            'H' => 9,
            'I' => 9,
            'J' => 11,
            'K' => 20,
            'L' => 11,
            'M' => 11,
            'N' => 25,
            'O' => 22,
            'P' => 30,
            'Q' => 11,
            'R' => 11,
            'S' => 30,
            'T' => 30,
       
        ];
    }
}

