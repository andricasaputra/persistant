<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class UserController extends Controller
{
	protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
	
    public function profile()
    {
    	return view('profile');
    }

    public function log()
    {
    	return view('log');
    }
}
