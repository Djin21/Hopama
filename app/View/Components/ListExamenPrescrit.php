<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Examen_prescrit;

class ListExamenPrescrit extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $examenPrescrits = Examen_prescrit::where('etatPaiement', 0)->get();
        return view('components.list-examen-prescrit', [
            'examenPrescrits' => $examenPrescrits
        ]);
    }
}
