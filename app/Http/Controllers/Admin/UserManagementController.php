<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Package;
use Spatie\Permission\Models\Role;
use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserRegisterRequest;

class UserManagementController extends Controller
{
    protected $repository, $paymentRepository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;

        $this->paymentRepository = app('Payments')->init(
            config('e-persistant.payments_gateway.default')
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->repository->all();

        return view('admin.users.index')->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $packages = Package::all()->pluck('name', 'id');

        return view('admin.users.create')->withPackages($packages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRegisterRequest $request)
    {
        $this->repository->store($request);        

        return redirect()->route('users.index')->withSuccess('User successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $status = $this->repository->paymentStatus($user);

        return view('admin.users.show')->withPayments($status); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->repository->edit($id);

        $roles = Role::all(); 

        $packages = Package::all()->pluck('name', 'id');

        return view('admin.users.edit', compact('user', 'roles', 'packages')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $this->repository->update($request, $id);

        return redirect()->route('users.index')->withSuccess('User successfully edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id); 

        $user->delete();

        return redirect()->route('users.index')->withSuccess('User successfully deleted.');
    }
}
