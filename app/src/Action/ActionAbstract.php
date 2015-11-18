<?php
/**
 * Slim Micro Service
 *
 * @link      https://github.com/mlatzko/SlimMicroService
 * @copyright Copyright (c) 2015 Mathias Latzko
 * @license   https://opensource.org/licenses/MIT
 */
namespace SlimMicroService\Action;

/**
 * This class contains the default behaviors required for all
 * action classes.
 *
 * @author Mathias Latzko <mathias.latzko@gmail.com>
 *
 * @version 0.1 In development.
 */
abstract class ActionAbstract
{
    /**
     * Contains an object of the lightweight Noodlehaus config class.
     *
     * @var \Noodlehaus\Config $config
     *
     * @link https://github.com/hassankhan/config
     */
    protected $config;

    /**
     * Contains PSR-3 logger provided by Monolog.
     *
     * @var \Psr\Log\LoggerInterface $logger
     *
     * @link https://github.com/Seldaek/monolog
     */
    protected $logger;

    /**
     * Contains a simple registry implementation.
     *
     * @var \App\Registry\RegistryInterface $registry
     */
    protected $adapter;

    /**
     * Constructor
     *
     * @param \Noodlehaus\Config              $config
     * @param \Psr\Log\LoggerInterface        $logger
     * @param \App\Registry\RegistryInterface $registry
     */
    public function __construct($config = NULL, $logger = NULL, $adapter = NULL)
    {
        if(NULL !== $config){
            $this->setConfig($config);
        }

        if(NULL !== $logger){
            $this->setLogger($logger);
        }

        if(NULL !== $adapter){
            $this->setAdapter($adapter);
        }
    }

    public function setConfig(\Noodlehaus\Config $config)
    {
        $this->config = $config;
    }

    public function setLogger(\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function setAdapter(\SlimMicroService\Adapter\AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * This method needs to implemented by all action classes.
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  array                                    $args
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    abstract public function dispatch($request, $response, $args);
}