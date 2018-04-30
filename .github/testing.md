# Testing Apiato
Run these tests, before moving to production, or making a Pull Request

## Install
Check your OS package manager & composer
`yarn global add` is the same as `npm i -g`
* [codesniffer](https://github.com/squizlabs/PHP_CodeSniffer)
* `npm i -g eslint jscs jshint sass-lint stylelint`
* optional: `prettier`

Note that jscs is deprecating, replaced by eslint, but is still useful

## Usage
* `cd apiato/`
* `composer validate`
* `yarn check`
* `eslint resources/`
* `jshint resources/`
* `jscs resources/`
* `sass-lint`
* `stylelint resources/assets/sass/*.scss`
* `phpunit`

## To Do
This test does not yet pass, but is coming soon. The `-w` is to suppress
warnings. Expect those to be cleaned, too

`phpcs --standard=PSR2 -w app/`

Testing API calls with one of
* phpunit
* frisby.js
* laravel dusk

More PHP static analysis, as code gets cleaned up
 
