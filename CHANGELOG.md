## [v11.0.0](https://github.com/apiato/apiato/compare/v10.0.15...v11.0.0) - 2022-04-27
Apiato 11 includes a variety of changes to the application skeleton. Please consult the diff to see what's new.

# Release Notes

### Added

- Added support for `Laravel 9.0`
- Added new method to transformers: nullableItem()  
  This helps in situations when you want to check if a relation is null and act base on that. So instead of writing something like this: `return $user->something ? $this->item($user->something, new SomethingTransformer()) : $this->primitive(null);` you can just write `$this->nullableItem($user->something, new SomethingTransformer())` which returns null if the relation doesn't exist.
- Added apiato:generate:policy command
- You can publish compatible containers configs using php artisan `vendor:publish` for now these containers are updated:
  Documentation
  SocialAuth
- Added new method: `transactionalRun()` to actions. This is just a wrapper around actions `run()` which puts in into a `db::transaction`
- New commands:
  - apiato:generate:factory
  - apiato:generate:event
  - apiato:generate:listener
  - apiato:generate:middleware
- `apiato:generate:container` command is greatly improved with new goodies!
  - added option to generate API events & listeners for generated container
  - added option to generate API tests for generated container
  - While generating Containers (API only) You can now choose to generate:
    - **Events Listeners** (experimental! I think this might be useless!)  
    If you choose to generate Events: Events will be implemented in Tasks, e.g. CreateOrderTask will fire OrderCreatedEvent
    - **Tests**  
    If you choose to generate Tests:  
    If Events are generated then the generated Tests will also test Events being fired!  
    **Note:** some generated tests are more like placeholders which you can uncomment and modify to your use case but nevertheless you will be way ahead!
    You can find the placeholder tests by searching for **TODO TEST**


### Fixed

- Fixed a small issue with the `HashIdTrait`
- Email verification now works actually! See the docs for more info.
- +Numerous more bugfixes...

### Changed

- Updated Dependencies in `composer.json` file to the latest versions
- In case of an `exception with empty error bag` we will now return {} instead of []
- Localization language files are now loaded from `languages` folder instead of `resources/languages`
- Global throttling on routes is now named `api` and is only applied to api routes and not the web routes and can be bypassed using `withoutMiddleware()` method on route.
- Login attribute (email, name, etc...) is now case insensitive. This behaviour can be changed in the configs.
- You can now choose between `Multi Action` or `Single Action` Controllers when using `apiato:generate:container` command.
- Almost all middlewares are moved from ship to core
- apiato:generate:serviceprovider is removed and changed into multiple separate commands 
  - apiato:generate:provider:generic
  - apiato:generate:provider:main
  - apiato:generate:provider:middleware
  - apiato:generate:provider:event

### Removed

- Removed(command): apiato:permissions:toRole
- Dropped support for Settings, Debugger, Payment




