<?php

declare(strict_types=1);

namespace Labrodev\Trackable;

use Illuminate\Support\Facades\Auth;
use ReflectionMethod;

trait ModelHasActorTracker
{
    /**
    * Boot the trait to automatically set created_by and updated_by attributes.
    *
    * @return void
    */
    public static function bootModelHasActorTracker(): void
    {
        static::creating(function ($model) {
            if ($model->modelHasActorTrackerCheckAttribute($model->modelHasActorTrackerCreatedByColumn())) {
                $model->{$model->modelHasActorTrackerCreatedByColumn()} = $model->modelHasActorTrackerIdentifier();
            }
        });

        static::updating(function ($model) {
            if ($model->modelHasActorTrackerCheckAttribute($model->modelHasActorTrackerUpdatedByColumn())) {
                $model->{$model->modelHasActorTrackerUpdatedByColumn()} = $model->modelHasActorTrackerIdentifier();
            }
        });
    }

    /**
     * Column to track the actor for creation.
     *
     * @return string
     */
    protected function modelHasActorTrackerCreatedByColumn(): string
    {
        return 'created_by';
    }

    /**
     * Column to track the actor for updates.
     *
     * @return string
     */
    protected function modelHasActorTrackerUpdatedByColumn(): string
    {
        return 'updated_by';
    }

    /**
     * Get the identifier of the authenticated user or 'system' if unauthenticated.
     *
     * @return mixed
     */
    protected function modelHasActorTrackerIdentifier(): mixed
    {
        if (Auth::user() !== null) {
            return Auth::user()->name ?? Auth::user()->getAuthIdentifier() ?? 'system';
        }

        return 'system';
    }

    /**
     * Check if the model has the specified attribute
     *
     * @param string $attributeName
     * @return bool
     */
    protected function modelHasActorTrackerCheckAttribute(string $attributeName): bool
    {
        $attributes = [];

        if (method_exists($this, 'getAttributes')) {
            $attributes = $this->getAttributes();
        }

        return isset($attributes[$attributeName]);
    }
}
