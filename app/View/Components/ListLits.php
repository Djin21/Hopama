<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Salle;
use App\Models\Lit;

class ListLits extends Component
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
        $lits = Lit::where('salle_id', $this->nom)->where('etat', 0)->get();
        return view('components.list-lits', [
            'lits' => $lits
        ]);
    }
}
