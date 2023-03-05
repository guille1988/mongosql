<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    private array $repositories = ['post', 'user', 'task', 'item'];


    public function buildPath(string $name, bool $isInterface = true, ?string $dbType = NULL): string
    {
        $repositoryPath = 'App\Repositories\\';

        return $isInterface ?
            $repositoryPath . "Interfaces\\$name" . 'RepositoryInterface' :
            $repositoryPath . "$dbType\\$name" . 'Repository';
    }

    public function bind(string $repository): void
    {
        $name = ucfirst($repository);
        $database = config('database.default') == 'mongodb' ? 'Mongo' : 'Sql';

        $this->app->bind($this->buildPath($name), $this->buildPath($name, false, $database));
    }

    public function register(): void
    {
        collect($this->repositories)->map(fn($repository) => $this->bind($repository));
    }

    public function boot(): void
    {
        $conditionToAccess = !$this->app->isProduction() && config('database.default') == 'mysql';

        Model::preventLazyLoading(!$this->app->isProduction());
        Model::preventAccessingMissingAttributes($conditionToAccess);

        Response::macro('success', function ($data)
        {
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        });

        Response::macro('error', function (array|string $errors, int $status)
        {
            return response()->json([
                'success' => false,
                'errors' => is_array($errors) ? $errors : ['errors' => [$errors]]
            ],$status);
        });
    }
}
