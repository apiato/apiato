<?php

namespace App\Ship\Engine\Traits;

use App\Ship\Parents\Factories\ResponseFactory;
use Auth;
use ErrorException;

/**
 * Class ResponseTrait
 *
 * @property \Dingo\Api\Dispatcher                                            $api
 * @property \Illuminate\Auth\GenericUser|\Illuminate\Database\Eloquent\Model $user
 * @property \Dingo\Api\Auth\Auth                                             $auth
 * @property \Dingo\Api\Http\Response\Factory                                 $response
 */
trait ResponseTrait
{

    /**
     * Controller scopes.
     *
     * @var array
     */
    protected $scopes = [];

    /**
     * Controller authentication providers.
     *
     * @var array
     */
    protected $authenticationProviders = [];

    /**
     * Controller rate limit and expiration.
     *
     * @var array
     */
    protected $rateLimit = [];

    /**
     * Controller rate limit throttles.
     *
     * @var array
     */
    protected $throttles = [];

    /**
     * Throttles for controller methods.
     *
     * @param string|\Dingo\Api\Contract\Http\RateLimit\Throttle $class
     * @param array                                              $options
     */
    protected function throttle($class, array $options = [])
    {
        $this->throttles[] = compact('class', 'options');
    }

    /**
     * Rate limit controller methods.
     *
     * @param int   $limit
     * @param int   $expires
     * @param array $options
     */
    protected function rateLimit($limit, $expires, array $options = [])
    {
        $this->rateLimit[] = compact('limit', 'expires', 'options');
    }

    /**
     * Add scopes to controller methods.
     *
     * @param string|array $scopes
     * @param array        $options
     */
    protected function scopes($scopes, array $options = [])
    {
        $scopes = $this->getPropertyValue($scopes);
        $this->scopes[] = compact('scopes', 'options');
    }

    /**
     * Authenticate with certain providers on controller methods.
     *
     * @param string|array $providers
     * @param array        $options
     */
    protected function authenticateWith($providers, array $options = [])
    {
        $providers = $this->getPropertyValue($providers);
        $this->authenticationProviders[] = compact('providers', 'options');
    }

    /**
     * Prepare a property value.
     *
     * @param string|array $value
     *
     * @return array
     */
    protected function getPropertyValue($value)
    {
        return is_string($value) ? explode('|', $value) : $value;
    }

    /**
     * Get the controllers rate limiting throttles.
     *
     * @return array
     */
    public function getThrottles()
    {
        return $this->throttles;
    }

    /**
     * Get the controllers rate limit and expiration.
     *
     * @return array
     */
    public function getRateLimit()
    {
        return $this->rateLimit;
    }

    /**
     * Get the controllers scopes.
     *
     * @return array
     */
    public function getScopes()
    {
        return $this->scopes;
    }

    /**
     * Get the controllers authentication providers.
     *
     * @return array
     */
    public function getAuthenticationProviders()
    {
        return $this->authenticationProviders;
    }

    /**
     * Get the authenticated user.
     *
     * @return mixed
     */
    protected function user()
    {
        return app(Auth::class)->user();
    }

    /**
     * Get the auth instance.
     *
     * @return \Dingo\Api\Auth\Auth
     */
    protected function auth()
    {
        return app(Auth::class);
    }

    /**
     * Get the response factory instance.
     *
     * @return \Dingo\Api\Http\Response\Factory
     */
    protected function response()
    {
        return app(ResponseFactory::class);
    }

    /**
     * Magically handle calls to certain properties.
     *
     * @param string $key
     *
     * @throws \ErrorException
     *
     * @return mixed
     */
    public function __get($key)
    {
        $callable = [
            'api',
            'user',
            'auth',
            'response',
        ];
        if (in_array($key, $callable) && method_exists($this, $key)) {
            return $this->$key();
        }
        throw new ErrorException('Undefined property ' . get_class($this) . '::' . $key);
    }

    /**
     * Magically handle calls to certain methods on the response factory.
     *
     * @param string $method
     * @param array  $parameters
     *
     * @throws \ErrorException
     *
     * @return \Dingo\Api\Http\Response
     */
    public function __call($method, $parameters)
    {
        if (method_exists($this->response(), $method) || $method == 'array') {
            return call_user_func_array([$this->response(), $method], $parameters);
        }
        throw new ErrorException('Undefined method ' . get_class($this) . '::' . $method);
    }
}
