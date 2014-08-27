<?php namespace Illuminate\Routing;

##
## See \vendor\laravel\framework\src\Illuminate\Routing\UrlGenerator.php
##

use Illuminate\Routing\UrlGenerator;

class CustomUrlGenerator extends UrlGenerator {


	/**
	 * Get the URL to a named route.
	 *
	 * @param  string  $name
	 * @param  mixed   $parameters
	 * @param  bool  $absolute
	 * @param  \Illuminate\Routing\Route  $route
	 * @return string
	 *
	 * @throws \InvalidArgumentException
	 */
	public function route($name, $parameters = array(), $absolute = true, $route = null)
	{
		$route = $route ?: $this->routes->getByName($name);

        #echo $name; die;

        ##
        ## Call url link modifier closure
        ##
        if (@is_callable($this->url_modifiers[$name])) {
            #\Helper::dd($parameters);
            $this->url_modifiers[$name]($parameters);
        }

		$parameters = (array) $parameters;

		if ( ! is_null($route))
		{
			return $this->toRoute($route, $parameters, $absolute);
		}
		else
		{
			throw new InvalidArgumentException("Route [{$name}] not defined.");
		}
	}

    ##
    ## Add url link modifier closure
    ##
    public function add_url_modifier($route_name = false, $closure) {

        if (!is_string($route_name) || !is_callable($closure))
            return false;

        #\Helper::dd($route_name);

        if (!@$this->url_modifiers || !@is_array($this->url_modifiers))
            $this->url_modifiers = array();

        $this->url_modifiers[$route_name] = $closure;

    }

}




