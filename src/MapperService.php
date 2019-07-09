<?php


namespace Thomzee\Laramap;


use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;

/**
 * Contains main functions of Laramap.
 * This class is extendable and overrideable.
 *
 * Class Response
 * @package Thomzee\Laramap
 */
class MapperService
{
    /**
     * Only returns success information.
     *
     * @return JsonResponse
     */
    public static function success()
    {
        $response = [
            'meta' => BaseMeta::success()
        ];

        return response()->json($response, JsonResponse::HTTP_OK);
    }

    /**
     * Only returns error information.
     *
     * @return JsonResponse
     */
    public static function error()
    {
        $response = [
            'meta' => BaseMeta::error()
        ];

        return response()->json($response, JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Returns single object data.
     * $item will be mapped based on BaseMapper child class.
     *
     * @param string $mapper
     * @param array|object $item
     * @return JsonResponse
     */
    public static function single(string $mapper, $item)
    {
        $mapper = new $mapper();
        if (!$mapper instanceof BaseMapper) {
            return response()->json(BaseMeta::error(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        $response = [
            'meta' => BaseMeta::success(),
            'data' => $mapper->single($item)
        ];

        return response()->json($response, JsonResponse::HTTP_OK);
    }

    /**
     * Returns array of data.
     * $items will be looped and mapped based on BaseMapper child class.
     *
     * @param string $mapper
     * @param $items
     * @return JsonResponse
     */
    public static function list(string $mapper, $items)
    {
        $mapper = new $mapper();
        if (!$mapper instanceof BaseMapper) {
            return response()->json(BaseMeta::error(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        $response = [
            'meta' => BaseMeta::success(),
            'data' => $mapper->list($items)
        ];

        return response()->json($response, JsonResponse::HTTP_OK);
    }

    /**
     * Returns paginated array of data.
     * $paged have to be instance of Laravel paginator class.
     *
     * @param string $mapper
     * @param Paginator $paged
     * @return JsonResponse
     */
    public static function paged(string $mapper, Paginator $paged)
    {
        $mapper = new $mapper();
        if (!$mapper instanceof BaseMapper) {
            return response()->json(BaseMeta::error(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        $response = [
            'meta' => BaseMeta::success(),
            'pages' => [
                'per_page' => $paged->perPage(),
                'current_page' => $paged->currentPage(),
                'last_page' => $paged->lastPage(),
                'has_more_pages' => $paged->hasMorePages(),
                'from' => $paged->firstItem(),
                'to' => $paged->lastItem()
            ],
            'links' => [
                'self' => $paged->perPage(),
                'next' => $paged->nextPageUrl(),
                'prev' => $paged->previousPageUrl(),
            ],
            'data' => $mapper->list($paged->items())
        ];

        return response()->json($response, JsonResponse::HTTP_OK);
    }

    /**
     * Returns error bag of Laravel validation.
     * $merged determines the form of error bag.
     *
     * @param Validator $validator
     * @param bool $merged
     * @return JsonResponse
     */
    public static function validation(Validator $validator, $merged = false)
    {
        $response = [
            'meta' => BaseMeta::validation($validator, $merged)
        ];

        return response()->json($response, JsonResponse::HTTP_OK);
    }
}
