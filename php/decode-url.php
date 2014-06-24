<?php
$baseUrl = $_SERVER['REQUEST_URI'];
$q       = strpos( $baseUrl, '?' );
if( $q > 0 ) {
    $baseUrl = substr( $baseUrl, 0, $q );
}
$q = strrpos( $baseUrl, '/' );
if( $q ) {
    if( $q != strlen( $baseUrl )-1 ) {
        $relativeUrl = substr( $baseUrl, $q+1 );
        $baseUrl     = substr( $baseUrl, 0, $q );
    } else {
        $relativeUrl = "";
        $baseUrl     = substr( $baseUrl, 0, strlen( $baseUrl )-1 );
    }
} else {
    $relativeUrl = "";
}
$baseUrl = ( isset( $_SERVER['HTTPS'] ) ? 'https://' : 'http://' ) . $_SERVER['SERVER_NAME'] . $baseUrl;
