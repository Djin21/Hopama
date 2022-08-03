<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Examen;

class ListExamen extends Component
{
    public $nom;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($nom)
    {
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
            $examens = Examen::orderBy('nom')->get();
            return view('components.list-examen', [
                'examens' =>$examens
            ]);
            
        }else{
            $examens = Examen::where("nom", "LIKE" , "%".$this->nom."%")->orderBy('nom')->get();
            return view('components.list-examen', [
                'examens' =>$examens
            ]);
        }
        // return view('components.list-examen');
    }
}
