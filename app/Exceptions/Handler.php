<?php

namespace App\Exceptions;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Redirect to dashboard when authorized action takees place.
     */
    public function render($request, Throwable $e)
    {
        if ($e instanceof AuthorizationException) {
            return response()->redirectTo(RouteServiceProvider::HOME);
        }
        if($e instanceof NotFoundHttpException) {
            return response()->redirectTo(RouteServiceProvider::HOME);
        }
        return parent::render($request, $e);
    }
}
