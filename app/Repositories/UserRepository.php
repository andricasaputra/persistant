<?php  

namespace App\Repositories;

use DB;
use App\Models\User;
use App\Models\Package;
use App\Events\UserRegister;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    use hasPackage, hasPayments;

    protected $profile = [];

    public function user()
    {
        return auth()->user();
    }

    public function setProfile(array $profile) 
    {
        $this->profile = $profile;
    }

    public function getProfile($key = null)
    {
        return isset($key) ? $this->profile[$key] : $this->profile;
    }

	public function all()
	{
		return User::withNoAdmin()->with('packages')->get();
	}

	public function store($request)
	{
        DB::beginTransaction();

        try {

            $name = explode('@', $request->email);

            $name = $name[0];

            $user = User::create([
                'name' => $name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'e_password' => $request->password,
            ]);

            event(new UserRegister($user, $request->id, $request->all()));

            DB::commit();

            return $user;

        } catch (\Exception $e) {

            DB::rollback();
            
            throw new \Exception($e->getMessage(), 1);
        }
		
	}

	public function edit($id)
	{
		return User::with('packages')->findOrFail($id);
	}

	public function update($request, $id)
	{
		$user = User::findOrFail($id); 

		$package = Package::whereId($request->package)->first();
 
        $input = $request->all(); 

        $roles = $request['roles'];

        $user->packages()->detach();

        $user->packages()->attach($package->id, [
            'valid_until' => now()->addMonths((int) $package->lifetime), 
            'created_at' => now()
        ]);

        $user->fill($input)->save();

        // khusus admin saja yang dapat memanipulasi roles
        if (admin()) {

            if (isset($roles)) {       

                $user->roles()->sync($roles); 

            } else {

                $user->roles()->detach();

            }
        }
	}

    public function checkPackageStatus()
    {
        $user = $this->user();

        $expired = $this->searchPackage('expired')->id;

        // Jika paket user expired
        if ($this->isExpiredPackage()) {

            // Hapus role subscriber dari user
            if ($user->hasRole('subscriber')) {

                $user->removeRole('subscriber');

            // Atau hapus role trial dari user
            } elseif ($user->hasRole('trial')) {

                $user->removeRole('trial');
            }

            // Jika user belum punya role unsubscriber
            // maka tambahkan role unsubscriber kepada user
            if (! $user->hasRole('unsubscriber')) {

                $user->assignRole('unsubscriber');

                // berikan paket expired pada user
                // 4 => Expired
                $user->packages()->sync($expired , [
                    'valid_until' => $this->oldValidUntil()
                ]);
            }
        }
    }
}