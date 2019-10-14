<?php  

namespace App\Http\View\Composer;

use Illuminate\View\View;
use App\Repositories\UserRepository;

class ProfileComposer
{
    protected $user;

	/**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('profile', app('Profile'));
        $view->with('package', $this->user->packageInfo());
    }
}