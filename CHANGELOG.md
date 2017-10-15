# Apiato Release Notes

## [Unreleased]

### Added
- Support ETags via a Middleware.
- Support Laravel Notifications.
- Add names for all the Route (`as`).
- Send Mail when user is registered.
- Send Notification using the default Database channel when user is registered.
- Add user registered Mail template `user-registered.blade.php`.
- Add User Registered Mail sample `UserRegisteredMail`.
- Add User Registered Notification sample `UserRegisteredNotification`.
- Support WePay payment gateway (in a new container).
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
- Add new Facade class `Apiato` containing the old Butlers classes functions, in addition to the `call` magical methode (`Apiato::call()`) in the `CallableTrait`.
- Add container specific config file to each container.
- Add readme.md file to each container.
- Add possibility to `customize` the way, `Exceptions` are displayed (cf. `ExceptionFormatters`)

### Changed
- Upgrade Mail to use Laravel 5.5 Mails. And add Ship directory for Mail in addition to user mail sample in the User container.
- Change default Mail driver from smtp to log.
- Remove `MailsAbstract.php` and `MailsInterface.php` from the Ship. To use the new Mail support in Apiato.
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
- Use `App/Ship/Exceptions/NotFoundException` instead of `App/Containers/User/Exceptions/UserNotFoundException`
- Change Containers Installer repository.

### Fixed
- Fix Social Authentication errors. 

### Removed
- Removed the `App/Ship/Payment` container as it now lives in `App/Containers/Payment`
- Removed the `ShipButler` and `ContainerButler` in favor of the new Apiato class.
- Removed the `App/Containers/User/Exceptions/UserNotFoundException`
