<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Packages\Exceptions\Note\FailDeleteNoteException;
use Packages\Exceptions\Note\FailRegisterNoteException;
use Packages\Exceptions\User\UserExistsException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function render($request, Throwable $e)
    {
        if ($e instanceof ValidationException) {
            return response()->json($e->errors(), 400);
        }

        return parent::render($request, $e);
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (UserExistsException $e) {
            return response()->json(['message' => '1ユーザーまでしか作成ができません。'], 400);
        });

        $this->reportable(function (FailRegisterNoteException $e) {
            return response()->json(['message' => 'ノートの登録に失敗しました。時間を置いてからもう一度お試しください。'], 400);
        });

        $this->reportable(function (FailDeleteNoteException $e) {
            return response()->json(['message' => 'ノートの削除に失敗しました。時間を置いてからもう一度お試しください。'], 400);
        });
    }
}
