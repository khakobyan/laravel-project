<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new Illuminate\Foundation\Application(
    realpath(__DIR__.'/../')
);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

$app->bind(
    App\Sections\Auth\Contracts\IAuthService::class,
    App\Sections\Auth\Services\AuthService::class
);
$app->bind(
    'api.services.auth',
    App\Sections\Auth\Contracts\IAuthService::class
);

$app->bind(
    App\Sections\Posts\Contracts\IPostService::class,
    App\Sections\Posts\Services\PostService::class
);
$app->bind(
    'api.services.posts',
    App\Sections\Posts\Contracts\IPostService::class
);

$app->bind(
    App\Sections\Posts\Contracts\IPostCommentService::class,
    App\Sections\Posts\Services\PostCommentService::class
);
$app->bind(
    'api.services.post-comments',
    App\Sections\Posts\Contracts\IPostCommentService::class
);

$app->bind(
    App\Sections\Users\Contracts\IUserService::class,
    App\Sections\Users\Services\UserService::class
);
$app->bind(
    'api.services.users',
    App\Sections\Users\Contracts\IUserService::class
);
$app->bind(
    App\Sections\Trade\Contracts\IProductService::class,
    App\Sections\Trade\Services\ProductService::class
);
$app->bind(
    'api.services.products',
    App\Sections\Trade\Contracts\IProductService::class
);
$app->bind(
    App\Sections\Trade\Contracts\IProductCommentService::class,
    App\Sections\Trade\Services\ProductCommentService::class
);
$app->bind(
    'api.services.product-comments',
    App\Sections\Trade\Contracts\IProductCommentService::class
);

return $app;
