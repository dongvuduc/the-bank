#  Bank Reconciliation System Import Data With OAuth2

This package helps you authenticate users on a Laravel API based on JWT tokens generated from Laravel OAuth2.

# Requirements
✔️ I`m building an API with Laravel.

✔️ Composer is need to run the command in Laravel. https://getcomposer.org/

✔️ I use Laravel Passport for authentication.

✔️ The frontend is a separated project: https://github.com/dongvuduc/the-office

✔️ The frontend users authenticate directly on Laravel OAuth2 to obtain a JWT token.

✔️ The frontend keep the JWT token from Server.

✔️ The frontend make requests to the Laravel API, with that token.

# Install

Config Database in .env

Require the package

<pre>composer install</pre>

Create Database

<pre>
php artisan migrate
php artisan db:seed
</pre>

Run with port 8000 (Local Server 8000 - Frontend 8080)

<pre>php artisan serve --port 8000</pre>

Create new Client for OAuth2 (Optional)

<pre>php artisan passport:client</pre>

# Account Demo

<pre>
Username: admin@admin.com
Password: 12345678

Username: office@office.com
Password: 12345678
</pre>



# API

CLIENT ID AND SECRET

<h3>Login With OAuth2 </h3>

Developers may use their client ID and secret to request an authorization code and access token from your application. First, the consuming application should make a redirect request to your application's like so:

<pre>GET http://SERVER_URL/oauth/authorize
{
    'client_id' => CLIENT_ID,
    'redirect_uri' => APP_URL_CALLBACK,
    'response_type' => 'code',
    'scope' => 'import'
}
</pre>

<h3>Converting Authorization Codes To Access Tokens</h3>

If the user approves the authorization request, they will be redirected back to the consuming application. The request should include the authorization code that was issued by your application when the user approved the authorization request:

<pre>POST http://SERVER_URL/oauth/token
{
    'grant_type' => 'authorization_code',
    'client_id' => CLIENT_ID,
    'client_secret' => CLIENT_SECRET,
    'redirect_uri' => APP_URL_CALLBACK,
    'code' => AUTHORIZATION_CODE_FROM_SERVER,
}
</pre>

<h3>Get Info User From Access Tokens</h3>

<pre>GET http://SERVER_URL/api/user
HEADER:
- Accept: application/json
- Authorization: Bearer access_tokens
</pre>

<h3>Import File Data With Access Tokens</h3>

<pre>POST http://SERVER_URL/api/import
HEADER:
- Accept: application/json
- Authorization: Bearer access_tokens
{
    import_file: FILE_EXCEL_OR_CSV
}
</pre>

# TESTING

<pre>php artisan test</pre>
