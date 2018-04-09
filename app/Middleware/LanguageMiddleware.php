<?php 


namespace App\Middleware;


/**
 * summary
 */
class LanguageMiddleware extends Middleware
{
    /**
     * summary
     */
    
    public function __invoke($req, $res, $next)
    {
    	if(isset($_SESSION['lang'])){
	    	$this->container->translator->setLocale($_SESSION['lang']);
    	}
        
        $res = $next($req, $res);
        return $res;
    }
}