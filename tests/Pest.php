<?php

use Labrodev\Trackable\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);

afterEach(function () {
    Mockery::close();
});
