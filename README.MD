# Laramap

## Docs
Laravel Mapper For Object Eloquent (Laravel)

## Installs

### For ABOVE Version Laravel 5.4 
a. go into your project root folder laravel 
```$xslt
    cd YOUR_LARAVEL_ROOT_PROJECT/
``` 
b. and type this
```$xslt
    composer require composer require thomzee/laramap
```
### For UNDER Version Laravel 5.4
a. go into your project root folder laravel 
```$xslt
    cd YOUR_LARAVEL_ROOT_PROJECT/
``` 
b. and type this
```$xslt
    composer require thomzee/laramap
```
c. and add to your ```config/app.php ``` , this line 
```$xslt
    Thomzee\Laramap\Response::class,
```

## How To Use
1 . Firstly you need to dumpautoload 
```$xslt
    composer dumpautoload
```
2 . and list artisan command, make sure ```php artisan make:mapper ``` is exist, and list artisan command with 
```$xslt
    php artisan list
```

3 . create mapper first for the object models Laravel, example:
```$xslt
    php artisan make:mapper UserMapper
```
4 . and on the controller using class **Response** 

5 . and add your new route to ```routes/api.php```

## Feature
##### 1. Paginate Data
Get List Object From Eloquent Collection with this example code
```$xslt
/**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return \Thomzee\Laramap\Response::paged(\App\Mappers\UserMapper::class, \App\User::paginate(10));
    }
```
the code above, with class **Response** From Laramap Package and using Mapper the one we create earlier which is ```UserMapper``` class, and the result is like this
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
Get Single Object From Eloquent Collection with this example code
```$xslt
/**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        return \Thomzee\Laramap\Response::single(\App\Mappers\UserMapper::class, \App\User::find($id));
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
Get List Data (Array Data) without paginate the items, with this example code
```$xslt
/**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function all()
    {
        return \Thomzee\Laramap\Response::list(\App\Mappers\UserMapper::class, \App\User::paginate(10));
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
set Response with Success meta, with no parameters.
```$xslt
/**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function all()
    {
        return \Thomzee\Laramap\Response::success();
    }
```
#### 5. Response For Validation
set Response to Fail Validation