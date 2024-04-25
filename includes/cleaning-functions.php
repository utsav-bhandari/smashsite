<?php
// this function removes all characters that are not letters or numbers

function clean_text($data)
{
    $cleaned_data = preg_replace("/[^A-Za-z0-9]/", '', $data);
    return ($cleaned_data);
}

// this function cleans integers

function clean_integer($data)
{
    $cleaned_int = (int) $data;
    return ($cleaned_int);
}

// this function cleans floats

function clean_float($data)
{
    $cleaned_float = (float) $data;
    return ($cleaned_float);
}