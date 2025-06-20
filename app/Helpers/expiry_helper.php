<?php

if (!function_exists('format_expiry_date')) {
    function format_expiry_date(string $expiryDateString, int $warningThreshold = 5): string
    {
        try {
            $expiryDate = new DateTime($expiryDateString);
            $today = new DateTime();
            $daysLeft = (int)$today->diff($expiryDate)->format('%r%a'); // Relative days difference

            if ($daysLeft < 0) {
                // Expired (red background)
                $bgClass = 'bg-danger text-white';
            } elseif ($daysLeft <= $warningThreshold) {
                // Warning (yellow background)
                $bgClass = 'bg-warning text-dark';
            } else {
                // OK (green background)
                $bgClass = 'bg-success text-white';
            }

            // Add padding and rounded corners with Bootstrap classes
            return '<span class="' . $bgClass . ' expiry-badge">' . $expiryDate->format('m-d-Y') . '</span>';

        } catch (Exception $e) {
            return esc($expiryDateString);
        }
    }
}
