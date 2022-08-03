<?php

namespace App\View\Components;

use App\Models\Session;
use Illuminate\View\Component;

class ListSession extends Component
{
    // public $nom;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->nom = $nom;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $sessions = Session::orderBy('created_at')->get();
        return view('components.list-session',[
            'sessions' => $sessions
        ]);
    }
}
