<?php  

namespace App\Http\View\Composer;

use Illuminate\View\View;

class AdminProfileComposer
{
	/**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $profile = [
            'nama' => 'admin',
            'nip' => '-'
        ];

        $view->with('profile', $profile);
    }
}