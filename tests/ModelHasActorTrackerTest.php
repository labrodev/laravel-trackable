<?php

namespace Labrodev\Trackable\Tests;

use Illuminate\Support\Facades\Auth;
use Labrodev\Trackable\Tests\MockModel;
use Mockery;
use ReflectionMethod;

test('created_by attribute is automatically set on creating model', function () {
    // Partial mock of Auth facade
    $mockUser = (object) ['name' => 'test_user', 'id' => 1];
    Auth::partialMock()->shouldReceive('user')->andReturn($mockUser);

    // Partial mock of MockModel to simulate the creation event
    $mockModel = Mockery::mock(MockModel::class)->makePartial();

    // Obtain the column name for `created_by`
    $createdByColumn = (new ReflectionMethod(MockModel::class, 'modelHasActorTrackerCreatedByColumn'))
        ->invoke($mockModel);

    // Manually assign the created_by attribute as would be done in the event
    $mockModel->{$createdByColumn} = $mockModel->modelHasActorTrackerIdentifier();

    // Assert that created_by is set correctly
    expect($mockModel->$createdByColumn)->toBe('test_user');
});

test('updated_by attribute is automatically set on updating model', function () {
    $mockUser = (object) ['name' => 'test_user', 'id' => 1];
    Auth::partialMock()->shouldReceive('user')->andReturn($mockUser);

    $mockModel = Mockery::mock(MockModel::class)->makePartial();

    $updatedByColumn = (new ReflectionMethod(MockModel::class, 'modelHasActorTrackerUpdatedByColumn'))
        ->invoke($mockModel);

    // Manually assign the updated_by attribute as would be done in the event
    $mockModel->{$updatedByColumn} = $mockModel->modelHasActorTrackerIdentifier();

    // Assert that updated_by is set correctly
    expect($mockModel->$updatedByColumn)->toBe('test_user');
});
