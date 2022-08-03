<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Personnel;

class ListPersonnel extends Component
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
            $personnels = Personnel::orderBy('nom')->get();
            return view('components.list-personnel', [
                'personnels' =>$personnels
            ]);
            
        }else{
            $personnels = Personnel::where("nom", "LIKE" , "%".$this->nom."%")->orderBy('nom')->get();
            return view('components.list-personnel', [
                'personnels' =>$personnels
            ]);
        }
        // return view('components.list-personnel');
    }
}
