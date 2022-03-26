<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\User;
use App\Models\Establecimiento;
use Livewire\WithFileUploads;
use File;
use Auth;

class UserTable extends Component
{

    use WithPagination;
    use WithFileUploads;

    public $perPage = 8;

    public $user_id;
    public $dni;
    public $name;
    public $password;
    public $type;
    public $message;

    public $tipodocumento;
    public $firma;

    public $establecimiento_id;

    public $estado = 'Guardar';
    public $sede;//establecimiento_id

    public $inputsearch;
    PUBLIC $inputsearchtype;
    
    public function mount(){
        $this->type='administrador';
        $this->tipodocumento='DNI';
    }
    public function render()
    {
        
        $sedes = null;
        $sede_nombre = null;

        if(Auth::user()->establecimiento_id==null){
            $sedes = Establecimiento::where(['estado'=>'1'])->get();
        }else{
            $lasede = Establecimiento::where(['id'=>Auth::user()->establecimiento_id,'estado'=>'1'])->first();

            if($lasede!=null){
                
                $this->establecimiento_id = $lasede->id;
                $sede_nombre = $lasede->nombre;
            }else{
                $this->establecimiento_id = 'sede eliminada'; //parche para que no cargue ningun dato
                $sede_nombre = 'Sede eliminada';
            }
            
        }
/*
        if($sedes->count()==1){
            $lasede = $sedes->first();
            $this->sede = $lasede->id;
        }*/
        
        $fields = ['establecimiento_id'=>$this->establecimiento_id];
        $fieldsor = ['establecimiento_id'=>$this->establecimiento_id];
        $users = null;

        if($this->inputsearchtype!=null && $this->inputsearchtype!=''){
            $fields[] = ['type'=>$this->inputsearchtype];
        }

        if($this->inputsearch!=null){
            $fields[] = ['name','like','%'.$this->inputsearch.'%'];
            $fieldsor[] = ['dni','like','%'.$this->inputsearch.'%'];

            if($this->establecimiento_id!=null && $this->establecimiento_id!=''){
                $users = User::where($fields)->orWhere($fieldsor)->paginate($this->perPage);
            }else{
                if($this->establecimiento_id==''){
                    $this->establecimiento_id = null;
                }
                $users = User::where([['name','like','%'.$this->inputsearch.'%']])->orWhere([['dni','like','%'.$this->inputsearch.'%']])->paginate($this->perPage);
            }
            
            
        }else{
           
            if(Auth::user()->establecimiento_id==null){
                if($this->establecimiento_id!=null && $this->establecimiento_id!=''){
                    if($this->inputsearchtype!=null && $this->inputsearchtype!=''){
                        $users = User::where(['type'=>$this->inputsearchtype])->WhereIn('establecimiento_id',[$this->establecimiento_id])->paginate($this->perPage);
                    }
                    else{
                        $users = User::WhereIn('establecimiento_id',[$this->establecimiento_id])->paginate($this->perPage);
                    }
                    
                }else{
                    if($this->inputsearchtype!=null && $this->inputsearchtype!=''){
                        
                        $users = User::where(['type'=>$this->inputsearchtype])->paginate($this->perPage);
                    }else{
                        $users = User::paginate($this->perPage);
                    }
                    
                }
                
            }else{
                $users = User::where(['establecimiento_id'=>$this->establecimiento_id])->paginate($this->perPage);
            }
            
        }

        
       
        return view('livewire.user-table',[
            'users'=>$users,
            'sedes'=>$sedes,
            'sede_nombre'=>$sede_nombre,
        ]);
    }
    public function editar($id){

        $this->resetForm();
        
        $user = User::find($id);

        

        $this->user_id = $user->id;
        $this->establecimiento_id = $user->establecimiento_id;
        $this->dni = $user->dni;
        $this->name = $user->name;
        $this->type = $user->type;
        $this->tipodocumento = $user->tipodocumento;
        $this->firma = $user->firma;

        

        $this->estado = 'Actualizar';

    }
    public function eliminar($id){

        $this->resetForm();
        
        $user = User::find($id)->delete();

    }
    public function store(){

        $newName = null;

        if($this->firma!=null){
            if(!is_string($this->firma)){
                $this->validate([
                    'firma' => 'image|max:10240', // 10MB Max
                ]);
    
                $name = $this->firma->getClientOriginalName();
                $newName = uniqid().'___'.$name;
                $this->firma->storeAs('',$newName,$disk = 'public');
            }
            
           
        }

        $dni_existe = User::where([
            ['dni',$this->dni],
            ['id','!=',$this->user_id]
            ])->get()->count();

        
        if($dni_existe==1){
            $this->message = 'El DNI ya está en uso';
            return;
        }
        
        if($this->establecimiento_id==''){
            $this->establecimiento_id = null;
        }

        $arrFiles = [
            'establecimiento_id'=>$this->establecimiento_id,
            'dni'=>$this->dni,
            'name'=>$this->name,
            'type'=>$this->type,
            'tipodocumento'=>$this->tipodocumento,
        ];

        if($this->password!=null){
            $arrFiles['password'] = Hash::make($this->password);
        }

        if($newName!=null){
            $arrFiles['firma'] = $newName;
        }

        $user_new = User::updateOrCreate([
            'id'=>$this->user_id
        ],$arrFiles);
     

        $this->resetForm();
        
        
    }
    public function resetForm(){
        $this->user_id = null;
        $this->dni = null;
        $this->name = null;
        $this->password = null;
        $this->type = 'administrador';
        $this->message=null;
        $this->estado = 'Guardar';
    }
    public function cancelar(){
        $this->resetForm();
    }
    public function resetdni(){
        $this->dni = null;
    }
    public function active($id,$estado){
        User::find($id)->update([
            'estado'=>$estado
        ]);
    }
    public function eliminarFirma($user_id,$firma){

        $user = User::find($user_id);
        if($user!=null){
            $user->update([
                'firma'=>null
            ]);

            $image_path = public_path("firmas/" . $firma);

            if(File::exists($image_path)) {
                File::delete($image_path);
            }
        }
    }
}
