<?php

namespace App\Containers\AppSection\Authentication\Tests\Unit\Classes;

use App\Containers\AppSection\Authentication\Actions\WebLoginAction;
use App\Containers\AppSection\Authentication\Classes\LoginFieldProcessor;
use App\Containers\AppSection\Authentication\Tests\UnitTestCase;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LoginRequest;
use App\Containers\AppSection\User\Data\Factories\UserFactory;
use Illuminate\Support\Facades\Config;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;

#[Group('authentication')]
#[CoversClass(LoginFieldProcessor::class)]
final class LoginFieldProcessorTest extends UnitTestCase
{
    public function testGivenValidLoginAttributeThenExtractUsername(): void
    {
        $userDetails = [
            'email' => 'gandalf@the.grey',
            'password' => 'youShallNotPass',
        ];

        $result = LoginFieldProcessor::extract($userDetails);

        $this->assertAttributeIsExtracted($result, $userDetails);
    }

    private function assertAttributeIsExtracted(array $result, array $userDetails): void
    {
        [$loginFieldValue, $loginFieldName] = $result;
        $this->assertSame($loginFieldValue, strtolower($userDetails['email']));
        $this->assertSame($loginFieldName, 'email');
    }

    public function testWhenNoLoginAttributeIsProvidedShouldUseEmailFieldAsDefaultFallback(): void
    {
        Config::offsetUnset('appSection-authentication.login.fields');
        $userDetails = [
            'email' => 'gandalf@the.grey',
            'password' => 'youShallNotPass',
        ];

        $result = LoginFieldProcessor::extract($userDetails);

        $this->assertAttributeIsExtracted($result, $userDetails);
    }

    public function testCanLoginWithUppercaseEmail(): void
    {
        Config::set('appSection-authentication.login.case_sensitive', false);
        $userDetails = [
            'email' => 'gAndAlf@tHe.grEy',
            'password' => 'youShallNotPass',
            'name' => 'Mahmoud',
        ];
        $this->testingUser = UserFactory::new()->createOne($userDetails);
        $request = LoginRequest::injectData($userDetails);
//        $request = LoginRequest::injectData([
//            'email' => 'gandalf@the.grey',
//            'password' => 'youShallNotPass',
//        ]);
        $action = app(WebLoginAction::class);

        $response = $action->run($request);

        $this->assertTrue($response->isRedirect());
        $this->assertAuthenticatedAs($this->testingUser, 'web');
    }
}
