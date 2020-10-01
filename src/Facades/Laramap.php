<?php


namespace Thomzee\Laramap\Facades;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Facade;
use Thomzee\Laramap\BaseMapper;

/**
 * Laravel REST API response mapper.
 *
 * @author     Thomas Andtianto
 * @license    MIT
 * @copyright  (c) 2019, Thomas Andrianto
 */

/**
 * @method index(BaseMapper $mapper, Paginator $paged, int $countAll, string $method, int $code = JsonResponse::HTTP_OK, array $additional = [])
 * @method single(BaseMapper $mapper, Model $single, string $method, int $code = JsonResponse::HTTP_OK, array $additional = [])
 * @method validation(Validator $validator, string $method, $merged = false, int $code = JsonResponse::HTTP_UNPROCESSABLE_ENTITY, array $additional = [])
 * @method success(string $method, int $code = JsonResponse::HTTP_OK, array $additional = [])
 * @method error($errorMessage, string $method, int $code = JsonResponse::HTTP_INTERNAL_SERVER_ERROR, array $additional = [])
 * @method fromArray(array $array, string $method, int $code = JsonResponse::HTTP_OK, array $additional = [])
 * @method fromObject($object, string $method, int $code = JsonResponse::HTTP_OK, array $additional = [])
 * @method mappedCollection(BaseMapper $mapper, $data, string $method, int $code = JsonResponse::HTTP_OK, array $additional = [])
 *
 */
class Laramap extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laramap';
    }
}
