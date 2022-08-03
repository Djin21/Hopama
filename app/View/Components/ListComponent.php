<?php

namespace App\View\Components;

use App\Models\Examen;
use App\Models\Type_consultation;
use Illuminate\View\Component;
// use Illuminate\Support\Facades\DB;

class ListComponent extends Component
{
    public $examen;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($examen)
    {
        $this->examen = $examen;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if($this->examen == '1'){
            $type_consultations = Type_consultation::orderBy('nom')->get();
            return view('components.list-component', [
                'type_consultations' =>$type_consultations
            ]);
            // if($this->name == '1'){
                // $examen = Examen::orderBy('nom')->get();
                // return view('components.list-component', [
                //     'examens' =>$examen
                // ]);
            // }
            
        }else{
            $type_consultations = Type_consultation::where("nom", "LIKE" , $this->examen."%")->get();
            return view('components.list-component', [
                'type_consultations' =>$type_consultations
            ]);
            // dd("Salut.,m,.");
            // $examen = Examen::all();
            // $examen = Examen::where("nom", "LIKE" , $this->examen."%")->get();
            // $examen = DB::table('examens')->where('nom', 'LIKE', "{$this->examen}%")->first();
            // return view('components.list-component', [
            //     'examens' =>$examen
            // ]);
        }
        
    }
}
