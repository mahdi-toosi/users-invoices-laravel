<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class avatar extends Component
{
    public $user;
    private string $avatarPath;

    public function __construct($user = null)
    {
        $this->user = is_null($user) ? auth()->user() : $user;
        $this->avatarPath = $this->user->avatar ? asset('storage/'.$this->user->avatar) : asset('/img/user.png');
    }

    public function render()
    {
        return view('components.avatar', [
            'avatarPath' => $this->avatarPath,
        ]);
    }
}
