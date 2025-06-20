<?php

if (!function_exists('formatToYMD')) {
    function formatToYMD($date, $inputFormat = null)
    {
        if (empty($date)) {
            return null; // or return '0000-00-00';
        }

        try {
            if ($inputFormat) {
                $d = DateTime::createFromFormat($inputFormat, $date);
                if ($d && $d->format($inputFormat) === $date) {
                    return $d->format('m-d-Y');
                }
            } else {
                $d = new DateTime($date);
                return $d->format('m-d-Y');
            }
        } catch (Exception $e) {
            return null; // or return '0000-00-00';
        }

        return null; // or '0000-00-00';
    }
}
