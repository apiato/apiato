<?php

declare(strict_types=1);

/**
 * @link https://mlocati.github.io/php-cs-fixer-configurator/
 * @link https://cs.symfony.com/doc/usage.html
 */
/** Don't use finder for vscode. It will be slow. */
$isVSCodeRun = isset($_SERVER['VSCODE_AGENT_FOLDER']);
$finder      = [];
if ($isVSCodeRun === false) {
    $finder = PhpCsFixer\Finder::create()
        ->ignoreVCS(true)
        ->ignoreDotFiles(true)
        ->name('*.php')
        ->notName(['*.blade.php', '_*'])
        ->exclude([
                'Containers/Vendor'
            ]
        )
        ->in([
            __DIR__ . '/app',
            __DIR__ . '/config',
            __DIR__ . '/tests',
            __DIR__ . '/database',
        ]);
}
$config = new PhpCsFixer\Config();

return $config
    ->setRiskyAllowed(true)
    ->setParallelConfig(PhpCsFixer\Runner\Parallel\ParallelConfigFactory::detect())
    ->setRules([
        // Global:
        '@PSR12'                                      => true,
        'psr_autoloading'                             => true,
        'single_quote'                                => true,
        'no_mixed_echo_print'                         => [
            'use' => 'echo',
        ],
        'heredoc_to_nowdoc'                           => true,
        'increment_style'                             => ['style' => 'post'],
        'no_empty_statement'                          => true,
        'no_short_bool_cast'                          => true,
        'no_unneeded_control_parentheses'             => true,
        'self_accessor'                               => true,
        'simplified_null_return'                      => false, // disabled by Shift
        'standardize_not_equals'                      => true,
        'simple_to_complex_string_variable'           => true,
        'declare_strict_types'                        => true, // thinking about it
        'void_return'                                 => false, // thinking about it
        'is_null'                                     => false, // thinking about it
        'strict_comparison'                           => true,
        'strict_param'                                => true, // https://mlocati.github.io/php-cs-fixer-configurator/#version:3.2|fixer:strict_param
        'ordered_traits'                              => true,

        // Disabled for any Global rules
        'phpdoc_no_alias_tag'                         => false,
        'phpdoc_types_order'                          => false,
        'phpdoc_tag_type'                             => false,
        'yoda_style'                                  => ['equal' => false, 'identical' => false, 'less_and_greater' => false],
        'single_line_throw'                           => false,
        'php_unit_test_case_static_method_calls'      => false,
        'php_unit_test_annotation'                    => false,
        'php_unit_strict'                             => false,
        'php_unit_set_up_tear_down_visibility'        => false,

        // Function/Methods/Const:
        'magic_method_casing'                         => true, // added from Symfony
        'magic_constant_casing'                       => true,
        'native_function_casing'                      => true,
        'no_alias_functions'                          => true,
        'no_trailing_comma_in_singleline'             => true,
        'combine_consecutive_unsets'                  => true,
        'explicit_indirect_variable'                  => true,
        'lambda_not_used_import'                      => true,

        // Unit
        'php_unit_method_casing'                      => true,

        // Import:
        'ordered_imports'                             => ['imports_order' => ['class', 'function', 'const'], 'sort_algorithm' => 'alpha'], //rewrite psr-12 rule
        'no_unused_imports'                           => true,
        'fully_qualified_strict_types'                => true,
        'native_function_invocation'                  => ['include' => ['@compiler_optimized'], 'scope' => 'namespaced', 'strict' => true],

        // Spacing/New Lines:
        'concat_space'                                => ['spacing' => 'one'],
        'cast_spaces'                                 => false,
        'unary_operator_spaces'                       => false,
        'linebreak_after_opening_tag'                 => true,
        'blank_line_after_opening_tag'                => true,
        'binary_operator_spaces'                      => ['default' => 'at_least_single_space', 'operators' => ['=>' => 'align_single_space_minimal']],
        'blank_line_before_statement'                 => ['statements' => ['return', 'do', 'exit', 'if', 'switch', 'try']],
        'no_extra_blank_lines'                        => ['tokens' => ['extra', 'throw', 'use']],
        'class_attributes_separation'                 => ['elements' => ['const' => 'one', 'method' => 'one', 'property' => 'one', 'trait_import' => 'none']],
        'type_declaration_spaces'                     => true,
        'include'                                     => true,
        'no_blank_lines_after_phpdoc'                 => true,
        'no_leading_namespace_whitespace'             => true,
        'no_multiline_whitespace_around_double_arrow' => true,
        'multiline_whitespace_before_semicolons'      => true,
        'no_singleline_whitespace_before_semicolons'  => true,
        'no_spaces_around_offset'                     => true,
        'not_operator_with_successor_space'           => false,
        'object_operator_without_whitespace'          => true,
        'space_after_semicolon'                       => true,
        'method_argument_space'                       => true,
        'return_assignment'                           => true,
        'single_space_around_construct'               => true,

        // Array:
        'array_syntax'                                => ['syntax' => 'short'],
        'trim_array_spaces'                           => true,
        'whitespace_after_comma_in_array'             => true,
        'no_whitespace_before_comma_in_array'         => true,
        'normalize_index_brace'                       => true,
        'trailing_comma_in_multiline'                 => true,
        'array_indentation'                           => true,

        // Comments:
        'align_multiline_comment'                     => ['comment_type' => 'phpdocs_like'],
        'single_line_comment_style'                   => ['comment_types' => ['hash']],

        // PhpDocs:
        'phpdoc_to_comment'                           => false,
        'phpdoc_indent'                               => true,
        'no_empty_phpdoc'                             => true,
        'phpdoc_no_access'                            => true,
        'phpdoc_no_package'                           => true,
        'phpdoc_no_useless_inheritdoc'                => true,
        'phpdoc_scalar'                               => true,
        'phpdoc_single_line_var_spacing'              => true,
        'phpdoc_summary'                              => true,
        'phpdoc_trim'                                 => true,
        'phpdoc_types'                                => true,
        'phpdoc_var_without_name'                     => true,
        'phpdoc_separation'                           => true,
        'phpdoc_align'                                => ['align' => 'vertical', 'tags' => ['param', 'property', 'property-read', 'property-write', 'return', 'throws', 'type', 'var', 'method']],
        'no_superfluous_phpdoc_tags'                  => true, // thinking about it
    ])->setFinder($finder);
