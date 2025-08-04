<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Passport Guard
    |--------------------------------------------------------------------------
    |
    | Here you may specify which authentication guard Passport will use when
    | authenticating users. This value should correspond with one of your
    | guards that is already present in your "auth" configuration file.
    |
    */

    'guard' => 'web',

    /*
    |--------------------------------------------------------------------------
    | Encryption Keys
    |--------------------------------------------------------------------------
    |
    | Passport uses encryption keys while generating secure access tokens for
    | your application. By default, the keys are stored as local files but
    | can be set via environment variables when that is more convenient.
    |
    */

    'private_key' => env('PASSPORT_PRIVATE_KEY'),

    'public_key' => env('PASSPORT_PUBLIC_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Passport Database Connection
    |--------------------------------------------------------------------------
    |
    | By default, Passport's models will utilize your application's default
    | database connection. If you wish to use a different connection you
    | may specify the configured name of the database connection here.
    |
    */

    'connection' => env('PASSPORT_CONNECTION'),

    /*
    |--------------------------------------------------------------------------
    | Client UUIDs
    |--------------------------------------------------------------------------
    |
    | By default, Passport uses auto-incrementing primary keys when assigning
    | IDs to clients. However, if Passport is installed using the provided
    | --uuids switch, this will be set to "true" and UUIDs will be used.
    |
    */

    'client_uuids' => true,

    /*
    |--------------------------------------------------------------------------
    | Personal Access Client
    |--------------------------------------------------------------------------
    |
    | If you enable client hashing, you should set the personal access client
    | ID and unhashed secret within your environment file. The values will
    | get used while issuing fresh personal access tokens to your users.
    |
    */

    'personal_access_client' => [
        'id' => env('PASSPORT_PERSONAL_ACCESS_CLIENT_ID'),
        'secret' => env('PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Hash Client Secrets
    |--------------------------------------------------------------------------
    |
    | By default, Passport will store the client secrets in plain text.
    | You may want to hash the client secrets before they are stored
    | in the database for added security.
    |
    */

    'hash_client_secrets' => env('PASSPORT_HASH_CLIENT_SECRETS', true),

    /*
    |--------------------------------------------------------------------------
    | Token Expiration Time
    |--------------------------------------------------------------------------
    |
    | Here you can set the default expiration time for access tokens.
    | The expiration time should be a `DateTime` instance, and you can
    | adjust the default duration here.
    |
    */

    'tokens_expire_in' => now()->addDays(90),

    /*
    |--------------------------------------------------------------------------
    | Refresh Token Expiration Time
    |--------------------------------------------------------------------------
    |
    | Set the expiration time for refresh tokens. This is how long the
    | refresh token will remain valid, allowing clients to obtain a new
    | access token.
    |
    */

    'refresh_tokens_expire_in' => now()->addDays(120),

];
