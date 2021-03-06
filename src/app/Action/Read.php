<?php
/**
 * Slim Micro Service
 *
 * @link      https://github.com/mlatzko/SlimMicroService
 * @copyright Copyright (c) 2015 Mathias Latzko
 * @license   https://opensource.org/licenses/MIT
 */

namespace SlimMicroService\Action;

use \SlimMicroService\Action;

/**
 * Behavior of reading a resource.
 *
 * @author Mathias Latzko <mathias.latzko@gmail.com>
 *
 * @version 1.0.0-RC-1
 */
class Read extends Action
{
    /**
     * Read resource.
     */
    public function dispatch($request, $response, $args)
    {
        $entity = $this->adapter->read($args['resource'], $args['id']);

        if(NULL === $entity){
            $responseData = array(
                'status'  => 'error',
                'content' => 'Resource not found.'
            );

            return $response
                ->withJson($responseData, 404);
        }

        // set response data
        $responseData = array(
            'status'  => 'ok',
            'content' => $entity
        );

        return $response
            ->withJson($responseData, 200);
    }
}
