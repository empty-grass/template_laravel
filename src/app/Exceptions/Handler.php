<?php

namespace App\Exceptions;

use Arr;
use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Exception\SuspiciousOperationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Routing\Router;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * @OverRide TokenMismatchExceptionが認証済み状態で発生した場合、セッション切れとみなす。
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $e)
    {
        // return parent::render($request, $exception);

        if (method_exists($e, 'render') && $response = $e->render($request)) {
            return Router::toResponse($request, $response);
        } elseif ($e instanceof Responsable) {
            return $e->toResponse($request);
        }

        $e = $this->prepareException($e);

        if ($e instanceof HttpResponseException) {
            return $e->getResponse();
        } elseif ($e instanceof AuthenticationException) {
            return $this->unauthenticated($request, $e);
        } elseif ($e instanceof TokenMismatchException) { // add
            if (auth()->check()) {
                return $request->expectsJson()
                            ? response()->json(['message' =>  __('error.exception.Authentication.json')], 401)
                            : redirect()->route('login')->with('alert', [
                                'status' => 'warning',
                                'message' => __('error.exception.Authentication.expired')
                            ]);
            }
            $e = new HttpException(419);
        } elseif ($e instanceof ValidationException) {
            return $this->convertValidationExceptionToResponse($e, $request);
        }

        return $request->expectsJson()
                        ? $this->prepareJsonResponse($request, $e)
                        : $this->prepareResponse($request, $e);
    }

    /**
     * @OverRide TokenMismatchExceptionの記載を削除(function render()へ移動)
     * Prepare exception for rendering.
     *
     * @param  \Throwable  $e
     * @return \Throwable
     */
    protected function prepareException(Throwable $e)
    {
        if ($e instanceof ModelNotFoundException) {
            $e = new NotFoundHttpException($e->getMessage(), $e);
        } elseif ($e instanceof AuthorizationException) {
            $e = new AccessDeniedHttpException($e->getMessage(), $e);
        // } elseif ($e instanceof TokenMismatchException) {
        //     $e = new HttpException(419, $e->getMessage(), $e);
        } elseif ($e instanceof SuspiciousOperationException) {
            $e = new NotFoundHttpException('Bad hostname provided.', $e);
        }

        return $e;
    }

    /**
     * @OverRide Redirect先にセッション切れフラッシュメッセージを渡す
     * Convert an authentication exception into a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function unauthenticated($request, $exception)
    {
        return $request->expectsJson()
                    ? response()->json(['message' =>  __('error.exception.Authentication.json')], 401)
                    : redirect()->guest($exception->redirectTo() ?? route('login'))->with('alert', [
                        'status' => 'warning',
                        'message' => __('error.exception.Authentication.expired')
                    ]);
    }

    /**
     * @OverRide Redirect先に共通バリデーションエラーのフラッシュメッセージを渡す
     * Convert a validation exception into a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Validation\ValidationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function invalid($request, ValidationException $exception)
    {
        return redirect($exception->redirectTo ?? url()->previous())
                    ->withInput(Arr::except($request->input(), $this->dontFlash))
                    ->withErrors($exception->errors(), $exception->errorBag)
                    ->with('alert', [
                        'status'  => 'warning',
                        'message' => __('error.exception.Validation')
                    ]);
    }
}
