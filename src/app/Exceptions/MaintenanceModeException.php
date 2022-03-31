<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;

class MaintenanceModeException extends ServiceUnavailableHttpException
{

    /**
     * Create a new exception instance.
     */
    public function __construct()
    {
        $maintenanceend_at = config('maintenance.maintenanceend_at', null);
        if (!is_null($maintenanceend_at)) {
            $maintenanceend_at = Carbon::parse($maintenanceend_at);
            $message = __('error.exception.MaintenanceMode', ['datetime' => $maintenanceend_at->format('Y-m-d H:i:s')]);
        } else {
            $message = __('error.exception.MaintenanceModeNoDatetime');
        }

        parent::__construct($retryAfter = null, $message);
    }
}
