<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Patient;

class ListPatient extends Component
{
    public $name;
    public $nom;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $nom)
    {
        $this->name = $name;
        $this->nom = $nom;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if($this->nom == '1'){
            $patient = Patient::orderBy('nom')->get();
            return view('components.list-patient', [
                'patients' =>$patient
            ]);
            
        }else{
            $patient = Patient::where("nom", "LIKE" , "%".$this->nom."%")->get();
            return view('components.list-patient', [
                'nom' => $this->nom,
                'patients' =>$patient
            ]);
        }
    }
}
