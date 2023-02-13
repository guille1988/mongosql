<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Exception;
use Error;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function errorDisplay(Exception | Error $error): string
    {
        return
            "Error details => ".
            "Message: {$error->getMessage()} | ".
            "File: {$error->getFile()} | " .
            "Line: {$error->getLine()} | ".
            "Code: {$error->getCode()}";
    }
}
