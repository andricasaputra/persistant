<?php  

namespace App\Repositories;

use App\Models\Package;

trait hasPackage
{
    public function userPackages()
    {
        return $this->user()->packages();
    }

    public function isActivePackage(): bool
    {
        return $this->userPackages()
                    ->active()
                    ->count() > 0;
    }

    public function isExpiredPackage(): bool
    {
        return $this->userPackages()
                    ->expired()
                    ->count() > 0;
    }

    public function packageInfo()
    {
        if ($this->isActivePackage()) {

            return $this->userPackages()->active()->first();
        }

        return $this->userPackages()->expired()->first();
    }

    public function oldValidUntil()
    {
        return $this->userPackages()->first()->getOriginal('pivot_valid_until');
    }

    public function searchPackage(string $name)
    {
        return Package::whereName($name)->first();
    }
}