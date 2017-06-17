---
title: "Containers"
category: "Features"
order: 110
---

## Containers

apiato ships with a few pre-defined and pre-configured containers. However, other developers may provide additional 
features in form of a respective container. This section explains, how so called `3rd party containers` may be 
automatically downloaded and installed to your specific web application.

**Note that this feature is only available for apiato > 4.1.3** 

### Downloading and Installing 3rd Party Containers

If you would like to use a specific container that was developed by a 3rd party developer, you can download them from 
GitHub or any other platform. However, you will not be able to automatically update them later on (e.g., if additional 
information is provided by the main developer).

apiato, however, provides an easy-to-use approach for downloading, installing and continuously updating containers from
3rd party developers. As an application developer, you simply need to include the respective `vendor/project` to the 
`composer.json` file within the `app/Containers` folder. 

For example, the respective `/app/Containers/composer.json` file may look something like this:
```
{
  "name": "apiato/containers",
  "description": "Composer file to include 3rd party containers.",
  "require": {
    "johannesschobel/apiato-null" : "dev-master"
  }
}

```

You then just need to call `composer update` in order to install the respective packages. The package (e.g., the container) 
`johannesschobel/apiato-null` is then installed to the `/app/Container` folder. However, the developer of this package 
needs to follow some basic guidelines (please see below!) in order to make this happen. 

**Important Information:**
Please **do not** modify content within a downloaded container, as it will be overwritten if you call `composer update`
again. 

### Developing a Container

Developing a container that can be used by others is quite easy. Basically, you can `extract` already existing functionality 
in a new container and provide the features. Note that you need to upload the container to `GitHub` and then release 
it on `Packagist` in order to be available via `Composer`. Please see a respective tutorial how to submit a package
to `GitHub` and release it via `Packagist`.

In particular, the only thing that needs to be done, when developing a container, is to provide a specific `composer.json` file
within the main folder of the container.

An example of such a `composer.json` file is shown below:

``` 
{
  "name": "vendor/project",
  "description": "This is a short description for your container.",
  "type": "apiato-container",   // you must set the type to "apiato-container" here!
  "require": {
    "somevendor/somepackage" : "dev-master"
    // some other requirements here
  },
  "extra": {
    "apiato": {
      "container": {
        "name": "Foo"   // The name of the container within the /app/Containers folder
      }
    }
  }
}
``` 

**Important Information:**
* You **must** add the respective `type : apiato-container` to the composer file. This way, the custom installer is used 
that allows installing / updating containers.
* You **must** provide the key `extra.apiato.container.name`. This key indicates the name of the folder (e.g., container) 
when installing the package to the `/app/Containers` folder. In the shown example, the container would be installed to 
`app/Containers/Foo`.

