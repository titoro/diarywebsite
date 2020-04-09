<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }

    /**
     * Render the given HttpException.
     * 参考：https://qiita.com/sola-msr/items/8a0ea0abe510245760ac
     * @param  \Symfony\Component\HttpKernel\Exception\HttpExceptionInterface  $e
     * @return \Symfony\Component\HttpFoundation\Response
     */
    // protected function renderHttpException(HttpExceptionInterface $e)
    // {
    //     $this->registerErrorViewPaths();

    //     // 「the page has expired due to inactivity. please refresh and try again」を表示させない
    //     if ($e->getStatusCode() === 419) {
    //         return redirect('/');
    //     }

    //     if (view()->exists($view = "errors::{$e->getStatusCode()}")) {
    //         return response()->view($view, [
    //             'errors' => new ViewErrorBag,
    //             'exception' => $e,
    //         ], $e->getStatusCode(), $e->getHeaders());
    //     }

    //     return $this->convertExceptionToResponse($e);
    // }
}
