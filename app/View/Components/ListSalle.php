<?php

namespace App\View\Components;

use App\Models\Salle;
use Illuminate\View\Component;

class ListSalle extends Component
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
            $salles = Salle::orderBy('nom')->get();
            // $services = Service::orderBy('nom')->get();
            return view('components.list-salle', [
                'salles' =>$salles
            ]);
            
        }else{
            $salles = Salle::where("nom", "LIKE" , "%".$this->nom."%")->orderBy('nom')->get();
            return view('components.list-salle', [
                'salles' =>$salles
            ]);
        }
        // return view('components.list-salle');
    }
}
