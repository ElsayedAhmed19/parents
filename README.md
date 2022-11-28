How to run?

We use the feature supported from laravel from version 8.0 of using `Laravel Sail` as an out of box tool for dockerizing laravel app
So Run this command `./vendor/bin/sail up` it will install laravel and containerize it.

1. Containerize app: `./vendor/bin/sail up`

2. Seeding providers: `./vendor/bin/sail artisan providers:seed`

3. Test using this end point `/api/v1/users?statusCode=authorised`

4. Run unit tests using `./vendor/bin/sail artisan test`
