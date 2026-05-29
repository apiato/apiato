# AGENTS.md

Guidance for AI agents and contributors working in this repository.

## What this is

Apiato is a PHP framework built on top of Laravel for building scalable, maintainable APIs. It follows the **Porto** Software Architectural Pattern: all application code lives in **Containers**, and shared infrastructure lives in the **Ship** layer.

## Structure

- `app/Containers/<Section>/<Container>/` , feature code, organized into Porto components (Actions, Tasks, Models, Routes, Requests, Transformers, and more). Almost all work happens here.
- `app/Ship/` , shared base classes, parents, and cross-container infrastructure.
- Standard Laravel directories: `config/`, `routes/`, `database/`, `tests/`, `public/`.

## Conventions

- Keep business logic inside Containers. Do not put feature logic in `Ship`.
- Scaffold with the `apiato:make:*` Artisan commands instead of hand-creating files:
  - `php artisan apiato:make:container` (interactive)
  - `apiato:make:action`, `:task`, `:model`, `:route`, `:request`, `:transformer`, etc.
- Match the patterns in neighboring Containers before introducing new ones.

## Commands

- Install: `composer install`
- Tests: `vendor/bin/phpunit`
- Code style (auto-fix): `vendor/bin/php-cs-fixer fix` (config: `.php-cs-fixer.dist.php`)
- Static analysis: `vendor/bin/phpstan analyse` and `vendor/bin/psalm`

Run the relevant checks before proposing changes. CI auto-applies php-cs-fixer on push.

## Docs

- Full documentation: https://apiato.io
- Machine-readable index: https://apiato.io/llms.txt

## Notes

- Do not edit `vendor/`, `_ide_helper.php`, or other generated files.
- Prefer extending Containers over modifying framework internals.
