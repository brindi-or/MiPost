return [

/*
|--------------------------------------------------------------------------
| Laravel CORS Options
|--------------------------------------------------------------------------
|
| The settings below are used by the Fruitcake\Cors middleware to handle
| Cross-Origin Resource Sharing (CORS) requests. Modify them as needed.
|
*/

'paths' => ['api/*', 'sanctum/csrf-cookie'],

'allowed_methods' => ['*'],

'allowed_origins' => ['*'], // You should specify your frontend domain here

'allowed_origins_patterns' => [],

'allowed_headers' => ['*'],

'exposed_headers' => [],

'max_age' => 0,

'supports_credentials' => true,

];
