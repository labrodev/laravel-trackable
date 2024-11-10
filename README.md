# Trackable for Laravel

The ModelHasActorTracker trait provides automatic tracking of the user who creates or updates a model record by setting created_by and updated_by attributes. This trait is useful in applications that require auditing changes and maintaining a record of the users responsible for creating and updating model instances.
## Installation

To install the package, run the following command in your Laravel project:

```bash
composer require labrodev/trackable
```

## Requirements

- PHP 8.1 or higher

## Configuration

After installing the package, no additional configuration is needed to start using the UUID trait in your models.

## Usage

To use the `ModelHasActorTracker` trait, simply include it in your Eloquent model:

```php 

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Labrodev\Trackable\ModelHasActorTracker;

class ExampleModel extends Model
{
    use ModelHasActorTracker;
}
```

Ensure that your model has 'updated_by', 'created_by' columns in model database table. 

If it is not, you may add it through Laravel migration: 

```php
$table->string('created_by');
$table->string('updated_by')
```

## Override column names

If the columns in your database table designated for tracking user actions through model has a names different from the default, you can customize the trait to accommodate this. 

Simply override the trait method in your model by adding the following methods with your specific column names:

```php 
 /**
 * Column to track the actor for creation.
 *
 * @return string
 */
protected function modelHasActorTrackerCreatedByColumn(): string
{
   return 'created_by'; // put your column name instead
}
```

```php 
 /**
 * Column to track the actor for updates
 *
 * @return string
 */
protected function modelHasActorTrackerUpdatedByColumn(): string
{
   return 'updated_by'; // put your column name instead
}
```

## Overwrite logic of actor identifier

You may overwrite logic of actor identifier which making actions through model by override the trait method:

```php 
/**
* @return mixed
*/
protected function modelHasActorTrackerIdentifier(): mixed
{
    // Put your own logic
}
```

## Testing

To run the tests included with the package, execute the following command:

```bash
composer test
```

For static analysis to check the package code, execute the followin command: 

```bash
composer analyse
```

## Security

If you discover any security-related issues, please email admin@labrodev.com instead of using the issue tracker.

## Credits

Labro Dev

## License

The MIT License (MIT). Please see License File for more information.
