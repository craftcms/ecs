<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\ClassNotation\VisibilityRequiredFixer;
use PhpCsFixer\Fixer\ControlStructure\TrailingCommaInMultilineFixer;
use PhpCsFixer\Fixer\FunctionNotation\FunctionDeclarationFixer;
use PhpCsFixer\Fixer\FunctionNotation\MethodArgumentSpaceFixer;
use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function(ECSConfig $ecsConfig): void {
    $ecsConfig->import(SetList::PSR_12);

    $services = $ecsConfig->services();
    $services->remove(MethodArgumentSpaceFixer::class);

    $ecsConfig->ruleWithConfiguration(FunctionDeclarationFixer::class, [
        'closure_function_spacing' => FunctionDeclarationFixer::SPACING_NONE,
    ]);
    $ecsConfig->ruleWithConfiguration(VisibilityRequiredFixer::class, [
        'elements' => ['method', 'property'],
    ]);
    $ecsConfig->ruleWithConfiguration(TrailingCommaInMultilineFixer::class, [
        'elements' => [
            TrailingCommaInMultilineFixer::ELEMENTS_ARRAYS,
        ],
    ]);
    $ecsConfig->rule(NoUnusedImportsFixer::class);
};
