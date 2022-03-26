<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use DB;
use File;

class FirmasPanel extends Component
{
    public function render()
    {
        $users = User::whereNotNull('firma')->get();

        return view('livewire.firmas-panel',[
            'users'=>$users
        ]);
    }
    public function cambiarprenombres(){
        $users = User::whereNotNull('firma')->get();
        if ($users!=null && count($users)>0) {
            DB::beginTransaction();
            try{

                foreach ($users as $user) {
                    $file = public_path('firmas/' . $user->firma);
                    if(file_exists($file)){
                        
                        
                        

                            $newNameFile = 'enfermero_' . $user->firma;
                            $to_path = public_path('firmas/' . $newNameFile);

                            User::find($user->id)->update([
                                'firma'=> $newNameFile,
                            ]);

                            File::move($file, $to_path);
                            

                        
                        
                    }
                }
                
                DB::commit();

            }catch(\Exception $e){

                DB::rollBack();
                return $e->getMessage();

            }

        }
    }
}
