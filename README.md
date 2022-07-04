Laravel package to create autonumber for Eloquent model

# Installation

install the package via composer:

```
composer require ramdani10/lara-autonumber
```

Register the ServiceProvider in `config/app.php`

```php
'providers' => [
    // ...
    Ramdani10\AutoNumber\AutoNumberServiceProvider::class,
],
```

Publish configuration

```
php artisan vendor:publish --provider='Ramdani\AutoNumber\AutoNumberServiceProvider'
```

Running migration

```
php artisan migrate
```

# Usage

use the `Ramdani10\AutoNumber\AutoNumberTrait` trait in model

implement method `getAutoNumberOptions()`.


```php
use Ramdani10\AutoNumber\AutoNumberTrait;
    
class Category extends Model
{
    use AutoNumberTrait;
    
    /**
     * Return the autonumber configuration array for this model.
     *
     * @return array
     */
    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => 'CA.?', // autonumber format. '?' will be replaced with the generated number.
                'length' => 3 // digits number
            ]
        ];
    }

}
```

pass a `closure` for the format value.

```php
public function getAutoNumberOptions()
{
    return [
        'order_number' => [
            'format' => function () {
                return 'CA/' . date('Ymd') . '/?'; // autonumber format. '?' will be replaced with the generated number.
            }
            'length' => 5 // The number of digits in the autonumber
        ]
    ];
}
```

## Saving Model

```php
$category = Category::create([
    'name' => 'Category A',
]);
```

The code will be automatically generated based on the format.

```php
dd($category->code);

// CA/20170803/00001
```