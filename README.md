# Easy Coding Standard config for Craft CMs

This package provides [Easy Coding Standard](https://github.com/symplify/easy-coding-standard) configurations for Craft CMS projects.

In general, we follow the [PSR-12](https://www.php-fig.org/psr/psr-12/) coding style guide, with a couple alterations:

- Multi-line function argument rules aren’t enforced. ([¶4.4](https://www.php-fig.org/psr/psr-12/#44-methods-and-functions))
- Spaces after the `function` keyword aren’t enforced. ([¶7](https://www.php-fig.org/psr/psr-12/#7-closures))
- Visibility is not enforced for constants, for Craft 3 projects.

To install, run the following commands:

```sh
composer config minimum-stability dev
```

```sh
composer config prefer-stable true
```

```sh
composer require craftcms/ecs:dev-main --dev
```

Then add an `ecs.php` file to the root of your project:

```php
<?php

declare(strict_types=1);

use craft\ecs\SetList;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Option;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::PATHS, [
        __DIR__ . '/src',
    ]);

    $containerConfigurator->import(SetList::CRAFT_CMS_4); // for Craft 3 projects
    $containerConfigurator->import(SetList::CRAFT_CMS_4); // for Craft 4 projects
};
```

Adjust the `PATHS` value to include all source/test code locations, and remove the appropriate `SetList` option,
depending on whether this is for a Craft 3 project, or Craft 4 project.

With that in place, you can check your project’s code with the following command:

```sh
vendor/bin/ecs check
```

And to automatically fix it as well, pass the `--fix` argument:

```sh
vendor/bin/ecs check --fix
```

You might also want to define `check-cs` and `fix-cs` scripts in `composer.json`:

```json
{
  "...": "...",
  "scripts": {
    "check-cs": "ecs check --ansi",
    "fix-cs": "ecs check --ansi --fix"
  }
}
```

Then you could execute ECS using `composer run-script`:

```sh
composer run-script check-cs
composer run-script fix-cs
```
