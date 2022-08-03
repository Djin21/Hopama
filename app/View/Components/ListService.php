<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Service;

class ListService extends Component
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
            $services = Service::orderBy('nom')->get();
            return view('components.list-service', [
                'services' =>$services
            ]);
            
        }else{
            $services = Service::where("nom", "LIKE" , "%".$this->nom."%")->orderBy('nom')->get();
            return view('components.list-service', [
                'services' =>$services
            ]);
        }
        // return view('components.list-service');
    }
}
