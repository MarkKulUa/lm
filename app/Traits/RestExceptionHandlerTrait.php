<?php
/**
 * Created by PhpStorm.
 * User: dn171183kmm2
 * Date: 19.07.17
 * Time: 11:21
 */

namespace App\Traits;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Illuminate\Validation\UnauthorizedException;

trait RestExceptionHandlerTrait
{
    protected $editional_errors = [];

    /**
     * Creates a new JSON response based on exception type.
     *
     * @param Request $request
     * @param Exception $e
     * @return \Illuminate\Http\JsonResponse
     */
    protected function getJsonResponseForException(Request $request, Exception $e)
    {
        if (config('app.debug')) {
            $this->editional_errors = [
                'exception' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTrace()
            ];
        }

        switch (true) {
            case $this->isModelNotFoundException($e):
                $retval = $this->modelNotFound($e->getMessage());
                break;
            case $this->isValidationException($e):
                $retval = $this->validationException($e->getMessage());
                break;
            case $e instanceof AuthorizationException:
                $retval = $this->authorizationException();
                break;
            case $e instanceof UnauthorizedHttpException:
                $retval = $this->unauthorizedHttpException();
                break;
            case $e instanceof UnauthorizedException:
                $retval = $this->unauthorizedException();
                break;
            case $e instanceof AuthenticationException:
                $retval = $this->unauthenticatedException();
                break;

            default:
                $retval = $this->badRequest($e->getMessage());
        }

        return $retval;
    }

    /**
     * Returns json response for generic bad request.
     *
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function badRequest($message=false, $statusCode=400)
    {
        if (!$message) {
            $message = 'Bad request';
        }

        return $this->jsonResponse(['status' => 'error', 'message' => $message], $statusCode);
    }



    /**
     * Returns json response.
     *
     * @param array|null $payload
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function jsonResponse(array $payload=null, $statusCode=404)
    {
        $payload = $payload ?: [];

        return response()->json(array_merge($payload, $this->editional_errors), $statusCode);
    }

    /**
     * Returns json response for Eloquent model not found exception.
     *
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function modelNotFound($message='Record not found', $statusCode=404)
    {
        return $this->jsonResponse(['status' => 'error', 'message' => $message], $statusCode);
    }

    /**
     * Returns json response for Eloquent model not found exception.
     *
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function validationException($message='Validation error', $statusCode=422)
    {
        if (!isset($message) || !$message || trim($message) == '') {
            $message = 'Validation error';
        }

        if (is_object($message) && method_exists($message, 'getMessage')) {
            $message = $message->getMessage();
        }

        return $this->jsonResponse(['status' => 'error', 'message' => $message], $statusCode);
    }

    protected function authorizationException($message='Unauthorized', $statusCode=401)
    {
        if (!isset($message) || !$message || trim($message) == '') {
            $message = 'Unauthorized';
        }

        if (is_object($message) && method_exists($message, 'getMessage')) {
            $message = $message->getMessage();
        }

        return $this->jsonResponse(['status' => 'error', 'message' => $message], $statusCode);
    }

    protected function unauthenticatedException($message='Unauthenticated', $statusCode=401)
    {
        if (!isset($message) || !$message || trim($message) == '') {
            $message = 'Unauthenticated';
        }

        if (is_object($message) && method_exists($message, 'getMessage')) {
            $message = $message->getMessage();
        }

        return $this->jsonResponse(['status' => 'error', 'message' => $message], $statusCode);
    }

    protected function unauthorizedException($message='Forbidden', $statusCode=403)
    {
        if (!isset($message) || !$message || trim($message) == '') {
            $message = 'Forbidden';
        }

        if (is_object($message) && method_exists($message, 'getMessage')) {
            $message = $message->getMessage();
        }

        return $this->jsonResponse(['status' => 'error', 'message' => $message], $statusCode);
    }

    /**
     * Determines if the given exception is an Eloquent model not found.
     *
     * @param Exception $e
     * @return bool
     */
    protected function isModelNotFoundException(Exception $e)
    {
        return $e instanceof ModelNotFoundException;
    }


    /**
     * Determines if the given exception is an Eloquent model not found.
     *
     * @param Exception $e
     * @return bool
     */
    protected function isValidationException(Exception $e)
    {
        return $e instanceof ValidationException;
    }

    protected function unauthorizedHttpException(Exception $e, $statusCode=401)
    {
        $preException = $e->getPrevious();

        if ($preException instanceof
            \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
            return $this->jsonResponse(['status' => 'error', 'message' => 'TOKEN_EXPIRED'], $statusCode);
        } elseif ($preException instanceof
            \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
            return $this->jsonResponse(['status' => 'error', 'message' => 'TOKEN_INVALID'], $statusCode);
        } elseif ($preException instanceof
            \Tymon\JWTAuth\Exceptions\TokenBlacklistedException) {
            return $this->jsonResponse(['status' => 'error', 'message' => 'TOKEN_BLACKLISTED'], $statusCode);
        } elseif ($e->getMessage() === 'Token not provided') {
            return $this->jsonResponse(['status' => 'error', 'message' => 'Token not provided'], 422);
        } else {
            return $this->jsonResponse(['status' => 'error', 'message' => 'Unauthorized'], $statusCode);
        }
    }
}
