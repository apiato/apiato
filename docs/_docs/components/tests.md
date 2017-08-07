---
title: "Tests"
category: "Optional Components"
order: 21
---

### Definition

Tests classes are created to test the Application classes are working as expected.

The two most essential Tests types for this architecture are the Unit Tests and the Functional Tests. However, Integration and Acceptance Tests can be used as well.

## Principles

- Containers MAY be covered by all types of Tests.

- Use Functional Tests to test Container Routes are doing what's expected from them.

- Use Unit Tests to test Container Actions and Tasks are doing what's expected from them.

### Rules

- All Container Tests classes SHOULD extend from a Container Internal TestCase class `{container-name}/tests/TestCase.php`. The container **TestCase** MUST extends from the main TestCase on the Ship layer `App\Ship\Parents\Tests\PhpUnit\TestCase`. *(Adding functions to the container TestCase allows sharing those functions between all Test classes of the Container)*.

### Folder Structure

```
 - app
    - Containers
        - {container-name}
            - Tests
                - TestCase.php // the container test case
                - Unit
                    - CreateUserTest.php
                    - UpdateUserTest.php
                    - ...
            - UI
                - API
                    - Tests
                        - Functional
                            - LoginTest.php
                            - LogoutTest.php
                            - ...
                - WEB
                    - Tests
                        - Functional
                            - LoginTest.php
                            - LogoutTest.php
                            - ...
                - CLI
                    - Tests
                        - Functional
                            - BackupDataTest.php
                            - ...
```

### Code Sample

```php
<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Containers\{container-name}\Tests\TestCase;
	
	class DeleteUserTest extends TestCase
    {
        protected $endpoint = '/users';

        protected $permissions = [
            'delete-users'
        ];

        public function testDeleteExistingUser_()
        {
            // get a testing user of type admin.
            $user = $this->getLoggedInTestingAdmin();

            // send the HTTP request
            $response = $this->apiCall($this->endpoint, 'delete');

            // assert response status is correct
            $this->assertEquals($response->getStatusCode(), '202');

            // ...
        }

    }
	 
```

##### See the **Tests Helpers** Page
