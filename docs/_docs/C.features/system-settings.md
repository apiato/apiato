---
title: "System Settings"
category: "Features"
order: 25
---

At many cases you need to have some dynamic system settings, such as in a referral program, where you give 'gifts' to anyone who refers new users. But those gifts can be changed in the future, so it's better not have them statically created in the code, instead read from the database where an  Admin can manage them at any time.

The `app/Containers/Settings` Container helps storing and retrieving those key values settings. It also seed the database with the default configurations during the installation.

#### Seed the default settings:

Default Settings should be seeded in `app/Containers/Settings/Database/Seeders/DefaultSystemSettingsSeeder.php`

#### Read settings:

```php
<?php
$value = $this->findSettingsByKeyTask->run('whateverSettingsName');
```

You can search for settings by Key as in the example above, or create a class for each settings as follow:

```php
<?php
$value = $this->findWhateverSettingsTask->run();
```
