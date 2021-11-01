<?php
namespace Bis2arch\Magento\v1\Sniffs\PHP;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class PrivateClassMemberSniff implements Sniff
{
    public function register()
    {
        return [
            T_PRIVATE,
        ];
    }

    public function process(File $phpcsFile, $stackPtr)
    {
        $phpcsFile->addWarning('Private class member detected.', $stackPtr, 'PrivateClassMemberError');
    }
}
