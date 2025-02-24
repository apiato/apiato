<?php

namespace App\Containers\AppSection\Authentication\Data\Dto;

final readonly class RefreshTokenGrant
{
    public string $grantType;

    private function __construct(
        public int $id,
        public string $secret,
        public string $scope = '',
    ) {
        $this->grantType = 'refresh_token';
    }

    public static function create(int $id, string $secret, string $scope = ''): self
    {
        return new self($id, $secret, $scope);
    }

    public function toArray(): array
    {
        return [
            'grant_type' => $this->grantType,
            'client_id' => $this->id,
            'client_secret' => $this->secret,
            'scope' => $this->scope,
        ];
    }
}
