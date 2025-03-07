<?php

namespace App\Containers\AppSection\Authentication\UI\API\Requests\WebClient;

use App\Containers\AppSection\Authentication\Data\DTOs\PasswordAccessTokenResponse;
use App\Ship\Parents\Requests\Request as ParentRequest;
use Illuminate\Validation\Rule;

final class RefreshTokenRequest extends ParentRequest
{
    protected array $decode = [];

    public function rules(): array
    {
        $cookieName = PasswordAccessTokenResponse::refreshTokenCookieName();

        return [
            'refresh_token' => [
                'string',
                Rule::requiredIf(
                    fn () => !$this->hasCookie($cookieName),
                ),
            ],
            $cookieName => [
                'string',
                Rule::requiredIf(
                    fn () => !$this->has('refresh_token'),
                ),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            PasswordAccessTokenResponse::refreshTokenCookieName() . '.string' => 'Refresh token cookie must be a string.',
        ];
    }

    public function prepareForValidation(): void
    {
        $cookieName = PasswordAccessTokenResponse::refreshTokenCookieName();
        if (!is_null($this->cookie($cookieName))) {
            $this->merge([
                $cookieName => $this->cookie($cookieName),
            ]);
        }
    }

    public function authorize(): bool
    {
        return $this->has('refresh_token') || $this->hasCookie(PasswordAccessTokenResponse::refreshTokenCookieName());
    }
}
