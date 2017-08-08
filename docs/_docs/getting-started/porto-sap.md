---
title: "Porto SAP"
category: "Getting Started"
order: 4
---

As you may know already, APIATO is architectured using the Porto Software Architectural Pattern. So you MUST read the [Porto Document](https://github.com/Mahmoudz/Porto) before getting started.

Porto consists of 2 layers the **Containers** layer and the **Ship** layer.

The Container layer holds the application business logic code, (wrapped in Containers). While the Ship layer holds your infrastructure code.

### Containers Layer

Read about the Containers layer [here](https://github.com/Mahmoudz/Porto#Containers-Layer)

#### Remove a Container (default Containers):

To remove a Container, simply delete the folder then run `composer update` to remove its dependencies.

#### Create new Container:

**Option 1) Using the Code Generator:**

`php artisan apiato:container`     (this method is not available yet, so jump to the manual creation below.)

**Option 2) manually:**

1. Create a folder in the Containers folder.

2. Start creating components and adding them in it.

*(The Ship engine will auto load and register everything automatically for you)*.

For the auto-loading to work flawlessly you MUST adhere to the component's naming conventions and structure. So you need to read the `documentation page` of every component before creating it.

##### Rules

- Containers names SHOULD start with Capital. Use CamelCase to rename Containers.

- Namespace should be the same as the container name, (if container name is "Printer" the namespace should be "App\Containers\Printer").

- Container MAY be named to anything however. A good practice is to name it to its most important Model name. *Example: if the User Story is (User can create a Stores and Stores can have Items) then we you could have 3 Containers (User, Store and Item).*

### Ship Layer

Read about the Ship layer **[here](https://github.com/Mahmoudz/Porto#Port-Layer)**























