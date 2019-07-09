<?php


namespace Thomzee\Laramap;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;

/**
 * Class BaseMeta
 * @package Thomzee\Laramap
 */
class BaseMeta
{
    /**
     * Returns meta of success.
     *
     * @return array
     */
    public static function success()
    {
        return [
            'code' => JsonResponse::HTTP_OK,
            'status' => 'success',
            'message' => 'Operation successfully executed.'
        ];
    }

    /**
     * Returns meta of error.
     *
     * @return array
     */
    public static function error()
    {
        return [
            'code' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
            'status' => 'error',
            'message' => 'Oops, something went wrong.'
        ];
    }

    /**
     * @param Validator $validator
     * @param bool $merged
     * @return array
     */
    public static function validation(Validator $validator, $merged = false)
    {
        $messageBag = $validator->errors();
        if ($merged) {
            $messageBag = $messageBag->all();
        }
        return [
            'code' => JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
            'status' => 'validation_error',
            'message' => 'Oops, something went wrong.',
            'errors' => $messageBag
        ];
    }
}
