<?php
namespace Bis2arch\Magento\v1\Sniffs\Security;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class SuperglobalSniff implements Sniff
{
    public $superGlobalErrors = [
        '$GLOBALS',
        '$_GET',
        '$_POST',
        '$_SESSION',
        '$_REQUEST',
        '$_ENV',
    ];

    public $superGlobalWarning = [
        '$_FILES',
        '$_COOKIE',
        '$_SERVER',
    ];

    public function register()
    {
        return [
            T_VARIABLE,
        ];
    }

    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $var = $tokens[$stackPtr]['content'];

        if (in_array($var, $this->superGlobalErrors)) {
            $phpcsFile->addError(
                'Direct use of %s Superglobal detected.',
                $stackPtr,
                'SuperglobalUsageError',
                [$var]
            );
        } elseif (in_array($var, $this->superGlobalWarning)) {
            $phpcsFile->addWarning(
                'Direct use of %s Superglobal detected.',
                $stackPtr,
                'SuperglobalUsageWarning',
                [$var]
            );
        }
    }
}
