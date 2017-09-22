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

### Changed
- Upgrade Mail to use Laravel 5.5 Mails. And add Ship directory for Mail in addition to user mail sample in the User container.
- Change default Mail driver from smtp to log.
- Remove `MailsAbstract.php` and `MailsInterface.php` from the Ship. To use the new Mail support in Apiato.
- Rename Middleware from `ResponseHeadersMiddleware` to `ValidateJsonContent`.
- Move Model traits from the Core Abstract class to the Ship Parent Class. To give user more control.
- Remove Exception when accept header is not provided by the request. 
- Changed Generators to add various fields (e.g., the `as` name for `Routes`)

### Fixed
- Fix Social Authentication errors. 

### Removed
- Removed the `App/Ship/Payment` container as it now lives in `App/Containers/Payment`
