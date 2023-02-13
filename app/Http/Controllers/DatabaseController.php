<?php

namespace App\Http\Controllers;

use App\Http\Requests\DatabaseRequest;
use Illuminate\Http\RedirectResponse;
use App\Services\DatabaseService;
use Exception;
use Error;

class DatabaseController extends Controller
{
    public function __invoke(DatabaseRequest $request, DatabaseService $databaseService): RedirectResponse
    {
        try
        {
            $database = $request->validated('is_sql') ? 'mysql' : 'mongodb';
            app('config')->write('database.default', $database);

            $databaseName = $databaseService->getName($database);
            $success = "Database switched to $databaseName successfully";

            sleep(3);

            return back()->with(compact('success'));
        }
        catch(Exception|Error $error)
        {
            return back()->with(compact('error'));
        }
    }
}
