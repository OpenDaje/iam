<?php
/*
 * This document has been generated with
 * https://mlocati.github.io/php-cs-fixer-configurator/#version:2.16.7|configurator
 * you can change this configuration by importing this file.
 */
return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules([
        //'@PSR2' => true,
        //'@PhpCsFixer' => true,
    ])
    ->setFinder(PhpCsFixer\Finder::create()
        ->exclude('vendor')
        ->exclude('extra')
        ->exclude('feature')
        ->in(__DIR__)
    )
;