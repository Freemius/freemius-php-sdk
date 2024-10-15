<?php

define('FS_API__ADDRESS', 'http://api.freemius-local.com:8080');


require_once 'freemius/FreemiusBase.php';
require_once 'freemius/Freemius.php';

define( 'FS__API_SCOPE', 'plugin' );
define( 'FS__API_ID', 0 );
define( 'FS__API_PUBLIC_KEY', 'your-public-key' );
define( 'FS__API_SECRET_KEY', 'your-secret-key' );
define( 'FS__API_LICENSE_KEY', 'your-license-key' );


$api = new Freemius_Api(
    FS__API_SCOPE,
    FS__API_ID,
    FS__API_PUBLIC_KEY,
    FS__API_SECRET_KEY
);

$result = $api->Api( "/licenses.json", "GET", array(
    'search' => FS__API_LICENSE_KEY,
) );

$license = null;

if ( ! empty( $result->licenses ) ) {
    echo '<pre>';
    var_dump( $result->licenses );
} else {
    echo 'No licenses found';
}
