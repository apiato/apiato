<?php

namespace App\Ship\Apps;

final readonly class AppFactory
{
    /**
     * @var array<string, class-string<App>>
     */
    private array $apps;

    private function __construct()
    {
        $this->apps = config()->array('apiato.apps');
    }

    public static function create(string $identifier): App
    {
        $instance = new self();
        if (!array_key_exists($identifier, $instance->apps)) {
            throw new \InvalidArgumentException("App [{$identifier}] not found.");
        }

        return new $instance->apps[$identifier]['class']();
    }

    public static function current(): App
    {
        return self::create(request()->appId());
    }
}
