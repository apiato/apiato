<?php

// Add your helper functions here...

if (!function_exists('apiato')) {
  /**
   * @param null $abstract
   * @param array $parameters
   * @return \Apiato\Core\Foundation\Apiato|mixed
   */
  function apiato($abstract = null, array $parameters = [])
  {
    /** @var \Apiato\Core\Foundation\Apiato $apito */
    $apito = app('Apiato');
    if (is_null($abstract)) {
      return $apito;
    }

    return $apito->call($abstract, $parameters);
  }
}
