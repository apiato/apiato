---
title: "Magical Call"
category: "Features"
order: 100
---

### The Magical Call

This magical function allows you to call any Action's or Task's `run` function, from any Controller or Action classes.

Each Action knows which UI called it using `$this->getUI()`, this is useful when handling the same Action differently based on the UI type (Web or API).


##### Basic Usage:

```php
$foo = $this->call(ActionOrTask::class);
```

##### Passing arguments to the `run` function:

```php
$foo = $this->call(ActionOrTask::class, [$runArgument1, $runArgument2, $runArgument3]);
```

##### Calling other functions before the `run`:

```php
$foo = $this->call(ActionOrTask::class, [$runArgument], ['otherFunction1', 'otherFunction2']);
```

##### Calling other functions and pass them arguments:

```php
$foo = $this->call(ActionOrTask::class, [$runArgument], [
    ['function1' => ['function1-argument1', 'function1-argument2']], 
    ['function2' => ['function2-argument1']], 
]);


$foo = $this->call(ActionOrTask::class, [$runArgument], [
    'function-without-argument',
    ['function1' => ['function1-argument1', 'function1-argument2']],  
]);

$foo = $this->call(ActionOrTask::class, [], [
    'function-without-argument',
    ['function1' => ['function1-argument1', 'function1-argument2']],
    'another-function-without-argument',
    ['function2' => ['function2-argument1', 'function2-argument2', 'function2-argument3']],
]);
```


