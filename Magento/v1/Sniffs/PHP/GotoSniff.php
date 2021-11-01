<?php
namespace Bis2arch\Magento\v1\Sniffs\PHP;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class GotoSniff implements Sniff
{
    public function register()
    {
        return [
            T_GOTO,
        ];
    }

    public function process(File $phpcsFile, $stackPtr)
    {
        $phpcsFile->addWarning('Use of goto is discouraged.', $stackPtr, 'Found');
    }
}
