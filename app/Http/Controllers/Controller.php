<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @SWG\Swagger(
     *     @SWG\Info(
     *         version="1.0.0",
     *         title="API Documentation",
     *         @SWG\License(name="API")
     *     ),
     *     @SWG\SecurityScheme(
     *         securityDefinition="access_token",
     *         type="apiKey",
     *         name="Authorization",
     *         in="header"
     *     ),
     *     basePath="/public/api",
     *     schemes={"http", "https"},
     *     consumes={"application/json"},
     *     produces={"application/json"}
     * )
     */

    public function __construct()
    {
        if (preg_match("/^\/(public)|(public\/index.php)/", request()->getBaseUrl())) {
            $redirect = str_replace(request()->getBaseUrl(), '', request()->getUri());
            redirect()->to($redirect, 301);
        }
    }
}
