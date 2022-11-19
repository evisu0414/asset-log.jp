<?php

declare(strict_types=1);

$finder = (new PhpCsFixer\Finder())
    ->in(dirname(__DIR__, 2))
    ->exclude(['bootstrap', 'storage', 'vendor'])
    ->notPath('public/index.php');

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12' => true,
        '@Symfony' => true,
        '@Symfony:risky' => true,
        'cast_spaces' => [
            'space' => 'none',
        ],
        'concat_space' => [
            'spacing' => 'one',
        ],
        'control_structure_continuation_position' => [
            'position' => 'same_line',
        ],
        'declare_strict_types' => true,
        'global_namespace_import' => [
            'import_classes' => true,
            'import_constants' => null,
            'import_functions' => null,
        ],
        'method_argument_space' => [
            'after_heredoc' => false,
            'keep_multiple_spaces_after_comma' => false,
            'on_multiline' => 'ensure_fully_multiline',
        ],
        'mb_str_functions' => true,
        'no_extra_blank_lines' => [
            'tokens' => [
                'continue',
                'curly_brace_block',
                'default',
                'extra',
                'parenthesis_brace_block',
                'square_brace_block',
                'switch',
                'throw',
                'use',
            ],
        ],
        'no_php4_constructor' => true,
        'no_superfluous_phpdoc_tags' => false,
        'no_unreachable_default_argument_value' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'php_unit_strict' => true,
        'phpdoc_align' => [
            'align' => 'left',
        ],
        'phpdoc_order' => true,
        'single_line_throw' => false,
        'strict_comparison' => true,
        'strict_param' => true,
        'void_return' => true,
    ])
    ->setFinder($finder)
    ->setCacheFile(__DIR__ . '/var/.php-cs-fixer.cache');
