<?php  

namespace App\Http\View\Composer;

use Illuminate\View\View;
use App\Repositories\UserRepository;

class ProfileComposer
{
    protected $repository;

	/**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if (! session()->has('profile')) {

            session()->put('profile', resolve('Profile')->profile());
        }

        $profile = session('profile', function(){

            //callback
            session()->put('callback_profile', resolve('Profile')->profile());

            return 'callback_profile';
        });

        $this->repository->setProfile($profile);

        $view->with('profile', $this->repository->getProfile());
        $view->with('package', $this->repository->packageInfo());
    }

}