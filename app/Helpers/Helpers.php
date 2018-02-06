<?php
/**
     * Set any link as active by adding active class
     *
     * @param [uri] Current URI
     * @param [output] Active
     * @return Active class
     */

function isActiveRoute($uri, $output = 'active')
{
    if (is_array($uri)) {
        foreach ($uri as $value) {
            if (Route::current()->uri == $value) {
                return $output;
            }
        }
    } else {
        if (Route::current()->uri == $uri) {
            return $output;
        }
    }
}


/*
* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
* SYSTEM
* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 */

function appendQueryString($params)
{
    $query = Request::all();
    foreach ($params as $key => $value) {
        $query[$key] = $value;
    }
    return Request::url() . '?' . http_build_query($query);
}

function isQueryString($params)
{
    return !array_diff($params, Request::all());
}
