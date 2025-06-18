<?php

if (!function_exists('valueOrNA')) {
    function valueOrNA($value)
    {
        return (!isset($value) || trim($value) === '') ? 'N/A' : $value;
    }
}
