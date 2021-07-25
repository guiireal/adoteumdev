<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class HomeScreen extends Component
{
    public function loginAsRecruiter()
    {
    }

    public function loginAsDev()
    {
        return redirect()->route('auth.github.redirect');
    }

    public function render()
    {
        return view('livewire.components.home-screen');
    }
}
