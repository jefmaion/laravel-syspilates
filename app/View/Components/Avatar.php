<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Laravolt\Avatar\Avatar as AvatarAvatar;

class Avatar extends Component
{

    public $user;
    public $size;
    public $avatar;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($user=null, $size='35px')
    {
        $this->user = $user;
        $this->size = $size;
        $this->avatar =  asset('avatar/'.$user->image);


        if(empty($user->image) || !file_exists(public_path('/avatar/' .$user->image ))) {
            $this->avatar = (new AvatarAvatar())->create($user->shortName)->toBase64();
        }

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.avatar');
    }
}
