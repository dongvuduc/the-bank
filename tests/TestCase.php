<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    const USER_TEST_USERNAME = 'admin@admin.com';
    const USER_TEST_PASSWORD = '12345678';

    const PASSPORT_CLIENT_ID = '931e54e1-8e2c-4d68-9acb-876caece37bd';
    const PASSPORT_CLIENT_SECRET = '3SiCAuMY1eVtrqduFm2n0l9hS4LtTbiPw0aDmdbD';

    // HTTP status constants
    const HTTP_BAD_REQUEST = 400;
    const HTTP_OK = 200;
    const HTTP_CREATED = 201;
    const HTTP_NO_CONTENT = 204;
    const HTTP_NOT_FOUND = 404;
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_WRONG_METHOD = 405;
    const HTTP_FORBIDDEN = 403;
    const HTTP_UNPROCESSABLE_ENTITY = 422;
    const HTTP_INTERNAL_ERROR = 500;
    const HTTP_SERVICE_UNAVALIABLE = 503;

    // HTTP method constants
    const HTTP_METHOD_GET = 'GET';
    const HTTP_METHOD_POST = 'POST';
    const HTTP_METHOD_PUT = 'PUT';
    const HTTP_METHOD_DELETE = 'DELETE';
    const HTTP_METHOD_PATCH = 'PATCH';
}
