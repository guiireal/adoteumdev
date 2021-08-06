<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class HomeScreen extends Component
{
    public function loginWithGoogle()
    {
        return redirect()->route('auth.google.redirect');
    }

    public function loginWithGithub()
    {
        return redirect()->route('auth.github.redirect');
    }

    public function render()
    {
        return view('livewire.components.home-screen');
    }
}
