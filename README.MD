# Laramap

## Introduction
Laramap is a Laravel package for object or array mapping in order to give a mature REST API response easier and cleaner.

## Installation
You can choose one of those two installation methods freely.
#### 1. Automatic Installation
Go into your project root folder laravel 
```$xslt
    cd YOUR_LARAVEL_ROOT_PROJECT/
``` 
then get the latest version of Laramap on your project with following command.
```$xslt
    composer require thomzee/laramap
```
#### 2. Manual Installation
Alternatively, you can update your composer.json file, just like code below
```$xslt
    "require": {
        . . .
        "thomzee/laramap": "dev-master"
    },
```
b. then run `composer install` command.
## Register Service
Firstly you need register the service provider your project configuration file `config/app.php` 
```$xslt
    'providers' => [
        . . .
        Thomzee\Laramap\LaramapServiceProvider::class,
    ]
```
and the facade as well in same file.
```$xslt
    'aliases' => [
        . . .
        'Laramap' => Thomzee\Laramap\Facades\Laramap::class,
    ]
```
Run `composer dump-autoload` command to update changes in your project configuration file.
```$xslt
    composer dump-autoload
```
## Mapper Class Generator
Make sure ```php artisan make:mapper``` is exist, and list artisan command with 
```$xslt
    php artisan list
```

then generate a mapper file with artisan command, example:
```$xslt
    php artisan make:mapper UserMapper
```
Update the content of single() method. The array keys is attributes of the response and $item is a representation of single object or array, example:
```$xslt
    function single($item)
    {
        return [
            "name" => $item->name,
            "email" => $item->email,
            "join_date" => $item->created_at,
        ];
    }
```
## Features
Import the package in above of your controller class.
```$xslt
    use Laramap;
```
That's it. That is because you has registered the package in your project configuration file.
#### 1. Paginated Data
Get list of paginated data with pages information.
First parameter must be Mapper class you generated before and the second must be instance of `Illuminate\Contracts\Pagination\Paginator`.
You can do where clause and other query builder functions before finally you call the paginate() function here.
```$xslt
    public function index()
    {
        return Laramap::paged(\App\Mappers\UserMapper::class, \App\User::paginate(10));
    }
```
the code above, using Mapper the one we create earlier which is ```UserMapper``` class, and the result is like this
```$xslt
{
    "meta": {
        "code": 200,
        "status": "success",
        "message": "Operation successfully executed."
    },
    "pages": {
        "per_page": 10,
        "current_page": 1,
        "last_page": 1,
        "has_more_pages": false,
        "from": 1,
        "to": 3
    },
    "links": {
        "self": 10,
        "next": null,
        "prev": null
    },
    "data": [
        {
            "name": Alex
        },
        {
            "name": Thomas
        },
        {
            "name": Uje
        }
    ]
}
```

#### 2. Single Data 
Get single object or array. You can even fill it with a Laravel collection
```$xslt
    public function show($id)
    {
        return Laramap::single(\App\Mappers\UserMapper::class, \App\User::find($id));
    }
```
and the result is like this
```$xslt
{
    "meta": {
        "code": 200,
        "status": "success",
        "message": "Operation successfully executed."
    },
    "data": {
        "name": Thomas
    }
}
```

#### 3. List Data
Get list data (array data) without paginate the items, with this example code
```$xslt
    public function all()
    {
        return Laramap::list(\App\Mappers\UserMapper::class, \App\User::paginate(10));
    }
```
and the result is something like this. 
```$xslt
{
    "meta": {
        "code": 200,
        "status": "success",
        "message": "Operation successfully executed."
    },
    "data": [
        {
            "name": Alex
        },
        {
            "name": Thomas
        },
        {
            "name": Uje
        }
    ]
}
```

#### 4. Success Response
Response success meta, with no parameters.
```$xslt
    public function all()
    {
        return Laramap::success();
    }
```
#### 4. Error Response
or and error meta.
```$xslt
    public function all()
    {
        return Laramap::error();
    }
```
#### 5. Response For Validation
Response Laravel Validation errors bag
```$xslt
    $validator = Validator::make($request->all(), [
        'foo' => 'required',
        'bar' => 'required'
    ]);
    if ($validator->fails()) {
        return Laramap::validation($validator);
    }
```
the result is
```$xslt
    {
        "meta": {
            "code": 422,
            "status": "validation_error",
            "message": "Oops, something went wrong.",
            "errors": {
                "foo": [
                    "The foo field is required."
                ],
                "bar": [
                    "The bar field is required."
                ]
            }
        }
    }
```
## License
This package is open-sourced software licensed under the MIT license.
