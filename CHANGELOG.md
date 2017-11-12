# Apiato Release Notes

## [Unreleased]

### Added
- Nothing.

### Changed
- Nothing.

### Fixed
- Nothing.

### Removed
- Nothing.




## v7.2.0 (2017-11-11)

### Added
- Added a new config flag (`apiato.requests.force-valid-includes` (default `true`)) to notify users about potential "invalid" `?include` query parameters
- Added ValueObjects class type to be extended by classes that do not requires to be stored in the DB or have ID.
- Added a `level` to the roles in order to indicate some kind of hierarchy (e.g., `admin` is "better" than `manager`).
- Added `/password-forgot` and `/password-reset` endpoints.
- Added Error Code Tables (`ApplicationErrorCodesTable` and `CustomErrorCodesTable`) in order to define exception codes in one place.

### Changed
- Changed the `Content-Language` header field (for requesting resources in a specific language) to `Accept-Language` instead (cf. [Specs](https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Accept-Language)).
- Rename `GiveAllPermissionsToRole` to `GiveAllPermissionsToRoleCommand`.
- The structure of the `supported_languages` in `App/Containers/Localization/Configs` was changed in order to support `regions`.
- The route `/logout` now uses `DELETE` instead of `POST` (to be more RESTful)
- Move `Localization` and `Region` from Model to ValueObjects folder in the localization container.
- Move `Output` and `RequestLogger` from Model to ValueObjects folder in the debugger container.
- The route `/user/profile` (the profile of the current user) now uses a dedicated `UserPrivateProfileTransformer` in order to allow adding "private" information more easily (instead of using if-blocks in the `UserTransformer`) 

### Fixed
- Fixed "bug", where an Exception is thrown if the user requested an invalid `?include` parameter. Now a "real" Apiato Exception is thrown.

### Removed
- Nothing.


___

## v7.1.0 (2017-10-17)

### Added
- Support ETags via a Middleware.
- Support Laravel Notifications.
- Add names for all the Route (`as`).
- Send Mail when user is registered.
- Send Notification using the default Database channel when user is registered.
- Add user registered Mail template `user-registered.blade.php`.
- Add User Registered Mail sample `UserRegisteredMail`.
- Add User Registered Notification sample `UserRegisteredNotification`.
- Add WePay payment gateway (in a new container).
- Add `force-accept-header` to the Apiato config file.
- Add `notification.php` config file.  
- Add migration file for the notification.
- Refactored the entire `Payment` process. It is now a "generic" plug-and-play architecture to handle different payment gateways (e.g., `Stripe`, `PayPal`, ...) see the corresponding docs for this feature.
- Add profiling to the response, via `ProfilerMiddleware`.
- Add notifications generator.
- Add the container generator
- Add feature to read custom stub files form `app/Ship/Generators/CustomStubs`
- Add command to sync all system permission with a given role.
- Support Apiato new class calling style `controllerName@ClassActionOrTask` in the magic call, example: `$role = $this->call('Authorization@FindRoleTask', [$request->role_id]);`. 
- Add new Facade class `Apiato` containing the old Butlers classes functions, in addition to the `call` magical method (`Apiato::call()`) in the `CallableTrait`.
- Add container specific config file to each container.
- Add `readme.md` file to each container.
- Add support for Exceptions Formatters (with some default Formatters). To allows users customize `Exceptions` JSON responses.
- Add project type to each container `composer.josn` file `"type": "apiato-container",`.

### Changed
- Upgrade Mail to use Laravel 5.5 Mails. And add Ship directory for Mail in addition to user mail sample in the User container.
- Change default Mail driver from smtp to log.
- Rename Middleware from `ResponseHeadersMiddleware` to `ValidateJsonContent`.
- Move Model traits from the Core Abstract class to the Ship Parent Class. To give user more control.
- Remove Exception when accept header is not provided by the request. 
- Changed Generators to add various fields (e.g., the `as` name for `Routes`)
- Refactor the Stripe container to work with the new payment gateway.
- Changed the "namespace" of all `generator` commands (from `apiato:x` to `apiato:generate:x`)
- When seeding data, the default Super Admin will be given the `admin` Role, but the `admin` role will not be given any permission. Can optionally use `php artisan apiato:permissions:toRole admin` to give the `admin` role all system permissions.    
- Renamed `FindUserAction` to `FindUserByIdAction`. And the controller function `findUser` to `findUserById`, and update the endpoint calling it.
- Renamed `FindMyProfileAction` to `GetAuthenticatedUserAction`. And rename the controller function `findUserProfile` to `getAuthenticatedUserAction`, and update the endpoint calling it. Also rename it's request from `FindMyProfileRequest` to `GetAuthenticatedUserRequest`.
- Renamed `GetAllAndSearchUsersAction` to `GetAllUsersAction`.
- Used `Apiato::call` in Seeder classes, instead of `App::make('Task')`. 
- Renamed `authentication.php` config file to `authentication-container.php`.
- Renamed `apidoc.php` config file to `documentation-container.php`.
- Renamed `localization.php` config file to `localization-container.php`.
- Renamed `payment.php` config file to `payment-container.php`.
- Renamed `wepay.php` config file to `wepay-container.php`.
- Rename `ListAll` to `GetAll` in every Actions/Tasks/controller functions/route files/requests
- Rename `Get` to `Find` in every Actions/Tasks/controller functions/route files/requests
- Slight adaptations to the `Exception` message format (due to `ExceptionFormatters`)
- Change Containers Installer repository. 
- Moved `AccountFailedException` from User container to the Socialauth container.
- Moved `App\Ship\Handlers\ExceptionsHandler` to `App\Ship\Exceptions\Handlers\ExceptionsHandler`.
- Change the directory of the Core Exceptions handler and rename it to become `Apiato\Core\Exceptions\Handlers\ExceptionsHandler`.

### Fixed
- Fix Social Authentication errors. 

### Removed
- Removed the `App/Ship/Payment` container as it now lives in `App/Containers/Payment`
- Removed the `ShipButler` and `ContainerButler` in favor of the new Apiato class.
- Removed the `App/Containers/User/Exceptions/UserNotFoundException`
- Removed the `App/Containers/User/Exceptions/UserNotFoundException` and replace it with `App/Ship/Exceptions/NotFoundException`. 
- Removed `MailsAbstract.php` and `MailsInterface.php` from the Ship. To use the new Mail support in Apiato.
