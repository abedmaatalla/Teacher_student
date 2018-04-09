<?php 

namespace App\Middleware;

/**
 * summary
 */
class Middleware
{
    /**
     * summary
     */
    
    protected $container;

    public function __construct($container)
    {
     	$this->container = $container;   
    }
}