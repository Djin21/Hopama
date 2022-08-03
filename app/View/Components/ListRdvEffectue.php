<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Consultation;

class ListRdvEffectue extends Component
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
        $consultations = Consultation::where('personnel_id', $this->name)->where('dateRealisation', '!=', Null)->orderBy('created_at', 'desc')->get();
        return view('components.list-rdv-effectue', [
            'consultations' => $consultations
        ]);
        // return view('components.list-rdv-effectue');
    }
}
