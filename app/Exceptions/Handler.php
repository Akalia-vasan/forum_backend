<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use App\Project\Frontend\Repo\Vehicle\EloquentVehicle;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
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
        if($exception instanceof CustomException) {
            return $this->showCustomErrorPage();
        }

        return parent::render($request, $exception);
    }

    protected function showCustomErrorPage()
    {
        $recentlyAdded = app(EloquentVehicle::class)->fetchLatestVehicles(0, 12);

        return view()->make('errors.404Custom')->with('recentlyAdded', $recentlyAdded);
    }
}
