<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
 * @OA\Info(
 *      version="1.0.0",
 *      title="L5 OpenApi",
 *      description="L5 Swagger OpenApi description",
 *      @OA\Contact(
 *          email="darius@matulionis.lt"
 *      )
 * )
 */

/**
 *  @OA\Server(
*      url="http://localhost:8000/api",
 *      description="L5 Swagger OpenApi Server"
 * )
 */
/**
 * @OA\SecurityScheme(
 *     type="http",
 *     description="Use a global client_id / client_secret and your username / password combo to obtain a token",
 *     name="Token Based",
 *     in="header",
 *     scheme="bearer",
 *     securityScheme="bearerAuth",
 *
 * )
 */

}
