<?php

namespace App\Containers\Authentication\Tasks;

use App\Containers\Authentication\Data\Transporters\ProxyApiLoginTransporter;
use App\Ship\Parents\Tasks\Task;

class ExtractLoginCustomAttributeTask extends Task
{

	/**
	 * @param \App\Containers\Authentication\Data\Transporters\ProxyApiLoginTransporter $data
   *
	 * @return array
	 */
	public function run(ProxyApiLoginTransporter $data): array
	{
      $prefix = config('authentication-container.login.prefix', '');
      $allowedLoginFields = config('authentication-container.login.attributes', ['email' => []]);

      $fields = array_keys($allowedLoginFields);

      $loginUsername = null;
      // The original attribute that which the user tried to log in witch
      // eg 'email', 'name', 'phone'
      $loginAttribute = null;

      // Find first login custom attribute (allowed login field) found in request
      // eg: search the request exactly in order which they are in 'authentication-container'
      // for 'email' then 'phone' then 'name' in request
      // and put the first one found in 'username' field witch its value as 'username' value
      foreach ($fields as $field) {
          $fieldName = $prefix . $field;
          // We don't use $data->getInputByKey($fieldname) method so this task can be compatible with both Request and
          // Transporter inputs. (Request doesn't have "getInputByKey()" method.
          $loginUsername = $data->$fieldName;
          $loginAttribute = $field;

          if ($loginUsername !== null) {
              break;
          }
      }

      return [
          'username' => $loginUsername,
          'loginAttribute' => $loginAttribute,
      ];
	}
}
