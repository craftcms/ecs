<?php

declare(strict_types=1);

use craft\ecs\fixers\ElseIfFixer;
use PhpCsFixer\Fixer\ClassNotation\VisibilityRequiredFixer;
use PhpCsFixer\Fixer\FunctionNotation\FunctionDeclarationFixer;
use PhpCsFixer\Fixer\FunctionNotation\MethodArgumentSpaceFixer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function(ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(SetList::PSR_12);

    $services = $containerConfigurator->services();
    $services->get(FunctionDeclarationFixer::class)->call('configure', [[
        'closure_function_spacing' => FunctionDeclarationFixer::SPACING_NONE,
    ]]);
    $services->get(VisibilityRequiredFixer::class)->call('configure', [[
        'elements' => ['method', 'property'],
    ]]);
    $services->remove(MethodArgumentSpaceFixer::class);
};
