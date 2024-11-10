<?php

namespace Labrodev\Trackable\Tests;

use Illuminate\Database\Eloquent\Model;
use Labrodev\Trackable\ModelHasActorTracker;

class MockModel extends Model
{
    use ModelHasActorTracker;
}
