<?php  

namespace App\Models\Traits;

use Ramsey\Uuid\Uuid as Generator;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

trait Uuids
{
    /**
     * Boot function from laravel.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            try {

                $model->{$model->getKeyName()} = Generator::uuid4()->toString();

            } catch (UnsatisfiedDependencyException $e) {

                abort(500, $e->getMessage());

            }
        });
    }
}