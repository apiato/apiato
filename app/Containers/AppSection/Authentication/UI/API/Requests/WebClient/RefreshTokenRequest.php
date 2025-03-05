<?php

namespace App\Containers\AppSection\Authentication\UI\API\Requests\WebClient;

use App\Containers\AppSection\Authentication\Data\DTOs\Token;
use App\Ship\Parents\Requests\Request as ParentRequest;
use Illuminate\Validation\Rule;

final class RefreshTokenRequest extends ParentRequest
{
    protected array $decode = [];

    public function rules(): array
    {
        return [
            'refresh_token' => ['string', Rule::requiredIf(fn () => !$this->hasCookie(Token::refreshTokenCookieName()))],
            Token::refreshTokenCookieName() => ['string', Rule::requiredIf(fn () => !$this->has('refresh_token'))],
        ];
    }

    public function messages(): array
    {
        return [
            Token::refreshTokenCookieName() . '.string' => 'Refresh token cookie must be a string.',
        ];
    }

    public function prepareForValidation(): void
    {
        if ($this->cookie(Token::refreshTokenCookieName())) {
            $this->merge([
                Token::refreshTokenCookieName() => $this->cookie(Token::refreshTokenCookieName()),
            ]);
        }
    }

    public function authorize(): bool
    {
        return $this->has('refresh_token') || $this->hasCookie(Token::refreshTokenCookieName());
    }
}
