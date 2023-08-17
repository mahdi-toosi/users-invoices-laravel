<?php

namespace App\View\Components;

use Illuminate\View\Component;

class avatar extends Component
{
    private string $avatarPath;

    public function __construct()
    {
        $this->avatarPath = auth()->user()->avatar ? asset('storage/'.auth()->user()->avatar) : asset('/img/user.png');
    }

    public function render()
    {
        return view('components.avatar', [
            'avatarPath' => $this->avatarPath,
        ]);
    }
}
