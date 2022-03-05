<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\ClassNotation\VisibilityRequiredFixer;
use PhpCsFixer\Fixer\ControlStructure\TrailingCommaInMultilineFixer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function(ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/craft-cms-3.php');

    $services = $containerConfigurator->services();
    $services->set(TrailingCommaInMultilineFixer::class)->call('configure', [[
        'elements' => [
            TrailingCommaInMultilineFixer::ELEMENTS_ARGUMENTS,
            TrailingCommaInMultilineFixer::ELEMENTS_ARRAYS,
            TrailingCommaInMultilineFixer::ELEMENTS_PARAMETERS,
        ],
    ]]);
    $services->get(VisibilityRequiredFixer::class)->call('configure', [['elements' => ['const', 'method', 'property']]]);
};
