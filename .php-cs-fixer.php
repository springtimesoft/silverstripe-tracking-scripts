<?php
/**
 * Project PHP formatting rules for php-cs-fixer.
 *
 * @see https://github.com/PHP-CS-Fixer/PHP-CS-Fixer
 * @see https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/index.rst
 * @see https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/ruleSets/index.rst
 */
$config = new PhpCsFixer\Config();

return $config->setRules(
    [
        '@PER'                   => true, // ruleset (PSR12)
        '@PhpCsFixer'            => true, // ruleset (includes @PER & @Symfony)
        'binary_operator_spaces' => [ // align array values
            'operators' => [
                '='  => 'align_single_space_minimal',
                '=>' => 'align_single_space_minimal',
            ],
        ],
        'concat_space'                           => ['spacing' => 'one'], // `'test' . 'ing'`
        'multiline_whitespace_before_semicolons' => false, // allow semi-colon on same line as multi-line func
        'no_unneeded_curly_braces'               => false, // breaks `namespace {`
        'ordered_class_elements'                 => false, // do not reorder class elements
        'phpdoc_no_empty_return'                 => false, // allow `@return void`
        'phpdoc_summary'                         => false, // don't add full stops to title
    ]
);
