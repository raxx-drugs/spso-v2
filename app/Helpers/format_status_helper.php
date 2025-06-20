<?php

if (!function_exists('format_status')) {
    function format_status(string $status): string
    {
        // Normalize status to lowercase for comparison
        $normalizedStatus = strtolower(trim($status));
        $badgeClass = 'bg-secondary text-white'; // default fallback

        switch ($normalizedStatus) {
            case 'pending':
            case 'inactive':
                $badgeClass = 'bg-warning text-dark';
                break;
            case 'approved':
            case 'published':
            case 'available':
            case 'active':
                $badgeClass = 'bg-success text-white';
                break;
            case 'cancelled':
            case 'canceled':
                $badgeClass = 'bg-danger text-white';
                break;
            case 'declined':
                $badgeClass = 'bg-dark text-white';
                break;
            case 'in progress':
            case 'draft':
                $badgeClass = 'bg-primary text-white';
                break;
            case 'completed':
            case 'arcihve':
                $badgeClass = 'bg-info text-white';
                break;
        }

        return '<span class="' . $badgeClass . ' status-badge px-2 py-1 rounded">' . ucfirst($status) . '</span>';
    }
}
