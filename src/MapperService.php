<?php


namespace Thomzee\Laramap;


use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use \Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;

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
     * @param BaseMapper $mapper
     * @param Paginator $paged
     * @param int $dataCount
     * @param string $method
     * @param int $code
     * @param array $additional
     * @return JsonResponse
     */
    public function index(
        BaseMapper $mapper,
        Paginator $paged,
        $dataCount,
        $method,
        $code = JsonResponse::HTTP_OK,
        array $additional = []
    )
    {
        $version = "1.0.1";
        $message = "Request is successfully executed.";
        $errors = [];
        $item = [];
        $items = $mapper->index($paged);
        $meta = $this->meta($code, $version, $method, $message);
        $pageInfo = $this->pageInfo(
            $paged->url($paged->currentPage()),
            $paged->url(1),
            $paged->url($paged->lastPage()),
            $paged->nextPageUrl(),
            $paged->previousPageUrl(),
            $paged->total(),
            $paged->perPage(),
            $paged->currentPage(),
            $dataCount,
            $paged->firstItem(),
            $paged->lastItem()
        );

        $data = [
            "message" => $message,
            "item" => (object)$item,
            "items" => $items,
            "additional" => $additional
        ];

        $response = [
            "meta" => $meta,
            "page_info" => $pageInfo,
            "errors" => $errors,
            "data" => $data
        ];

        return Response::json($response, $code);
    }

    /**
     * @param BaseMapper $mapper
     * @param Model $single
     * @param string $method
     * @param int $code
     * @param array $additional
     * @return JsonResponse
     */
    public function single(
        BaseMapper $mapper,
        Model $single,
        $method,
        $code = JsonResponse::HTTP_OK,
        array $additional = []
    )
    {
        $version = "1.0.1";
        $message = "Request is successfully executed.";
        $errors = [];
        $items = [];
        $item = $mapper->single($single);
        $meta = $this->meta($code, $version, $method, $message);
        $pageInfo = $this->pageInfo(URL::full());

        $data = [
            "message" => $message,
            "item" => (object)$item,
            "items" => $items,
            "additional" => $additional
        ];

        $response = [
            "meta" => $meta,
            "page_info" => $pageInfo,
            "errors" => $errors,
            "data" => $data
        ];

        return Response::json($response, $code);
    }

    /**
     * @param Validator $validator
     * @param string $method
     * @param bool $merged
     * @param int $code
     * @param array $additional
     * @return JsonResponse
     */
    public function validation(
        Validator $validator,
        $method,
        $merged = false,
        $code = JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
        array $additional = []
    )
    {
        $version = "1.0.1";
        $messageBag = $validator->errors();
        if ($merged) {
            $messageBag = $messageBag->all();
        }
        $errors = $messageBag;
        $items = [];
        $item = [];
        $message = $messageBag->first();
        $meta = $this->meta($code, $version, $method, $message);
        $pageInfo = $this->pageInfo(URL::full());

        $data = [
            "message" => $message,
            "item" => (object)$item,
            "items" => $items,
            "additional" => $additional
        ];

        $response = [
            "meta" => $meta,
            "page_info" => $pageInfo,
            "errors" => [$errors],
            "data" => $data
        ];

        return Response::json($response, $code);
    }

    /**
     * @param string $method
     * @param int $code
     * @param array $additional
     * @return JsonResponse
     */
    public function success(
        $method,
        $code = JsonResponse::HTTP_OK,
        array $additional = []
    )
    {
        $version = "1.0.1";
        $message = "Request is successfully executed.";
        $errors = [];
        $items = [];
        $item = [];
        $meta = $this->meta($code, $version, $method, $message);
        $pageInfo = $this->pageInfo(URL::full());

        $data = [
            "message" => $message,
            "item" => (object)$item,
            "items" => $items,
            "additional" => $additional
        ];

        $response = [
            "meta" => $meta,
            "page_info" => $pageInfo,
            "errors" => $errors,
            "data" => $data
        ];

        return Response::json($response, $code);
    }

    /**
     * @param $errorMessage
     * @param string $method
     * @param int $code
     * @param array $additional
     * @return JsonResponse
     */
    public function error(
        $errorMessage,
        $method,
        $code = JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
        array $additional = []
    )
    {
        $version = "1.0.1";
        $message = $errorMessage;
        $errors = [
            ["errors" => $errorMessage]
        ];
        $items = [];
        $item = [];
        $meta = $this->meta($code, $version, $method, $message);
        $pageInfo = $this->pageInfo(URL::full());

        $data = [
            "message" => $message,
            "item" => (object)$item,
            "items" => $items,
            "additional" => $additional
        ];

        $response = [
            "meta" => $meta,
            "page_info" => $pageInfo,
            "errors" => $errors,
            "data" => $data
        ];

        return Response::json($response, $code);
    }

    /**
     * @param array $array
     * @param string $method
     * @param int $code
     * @param array $additional
     * @return JsonResponse
     */
    public function fromArray(
        array $array,
        $method,
        $code = JsonResponse::HTTP_OK,
        array $additional = []
    )
    {
        $version = "1.0.1";
        $message = "Request is successfully executed.";
        $errors = [];
        $items = $array;
        $item = [];
        $meta = $this->meta($code, $version, $method, $message);
        $pageInfo = $this->pageInfo(URL::full());

        $data = [
            "message" => $message,
            "item" => (object)$item,
            "items" => $items,
            "additional" => $additional
        ];

        $response = [
            "meta" => $meta,
            "page_info" => $pageInfo,
            "errors" => $errors,
            "data" => $data
        ];

        return Response::json($response, $code);
    }

    /**
     * @param $object
     * @param string $method
     * @param int $code
     * @param array $additional
     * @return JsonResponse
     */
    public function fromObject(
        $object,
        $method,
        $code = JsonResponse::HTTP_OK,
        array $additional = []
    )
    {
        $version = "1.0.1";
        $message = "Request is successfully executed.";
        $errors = [];
        $items = [];
        $item = $object;
        $meta = $this->meta($code, $version, $method, $message);
        $pageInfo = $this->pageInfo(URL::full());

        $data = [
            "message" => $message,
            "item" => (object)$item,
            "items" => $items,
            "additional" => $additional
        ];

        $response = [
            "meta" => $meta,
            "page_info" => $pageInfo,
            "errors" => $errors,
            "data" => $data
        ];

        return Response::json($response, $code);
    }

    /**
     * @param BaseMapper $mapper
     * @param $data
     * @param string $method
     * @param int $code
     * @param array $additional
     * @return JsonResponse
     */
    public function mappedCollection(
        BaseMapper $mapper,
        $data,
        $method,
        $code = JsonResponse::HTTP_OK,
        array $additional = []
    )
    {
        $version = "1.0.1";
        $message = "Request is successfully executed.";
        $errors = [];
        $item = [];
        $items = $mapper->index($data);
        $meta = $this->meta($code, $version, $method, $message);
        $pageInfo = $this->pageInfo(URL::full());

        $data = [
            "message" => $message,
            "item" => (object) $item,
            "items" => $items,
            "additional" => $additional
        ];

        $response = [
            "meta" => $meta,
            "page_info" => $pageInfo,
            "errors" => $errors,
            "data" => $data
        ];

        return Response::json($response, $code);
    }

    /**
     * @param string $selfUrl
     * @param string $firstPageUrl
     * @param string $lastPageUrl
     * @param string $nextUrl
     * @param string $prevUrl
     * @param int $total
     * @param int $perPage
     * @param int $currentPage
     * @param int $count
     * @param int $from
     * @param int $to
     * @return array
     */
    protected function pageInfo(
        $selfUrl = "",
        $firstPageUrl = "",
        $lastPageUrl = "",
        $nextUrl = "",
        $prevUrl = "",
        $total = 1,
        $perPage = 1,
        $currentPage = 1,
        $count = 1,
        $from = 1,
        $to = 1
    )
    {
        $lastPage = floor($total / $perPage) + 1;
        return [
            "total" => $total,
            "per_page" => $perPage,
            "first_page" => 1,
            "current_page" => $currentPage,
            "last_page" => $lastPage,
            "first_page_url" => $firstPageUrl,
            "last_page_url" => $lastPageUrl,
            "next_page_url" => $nextUrl,
            "prev_page_url" => $prevUrl,
            "self_page_url" => $selfUrl,
            "count" => $count,
            "from" => $from,
            "to" => $to
        ];
    }

    /**
     * @param int $code
     * @param string $version
     * @param string $method
     * @param string $message
     * @return array
     */
    protected function meta($code, $version, $method, $message)
    {
        return [
            "code" => $code,
            "version" => $version,
            "method" => $method,
            "message" => $message
        ];
    }
}
