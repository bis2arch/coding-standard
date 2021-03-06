<?php
/**
 * When catching an exception inside a namespace it is important that you escape to the global space.
 */
namespace Bis2arch\Magento\v1\Sniffs\PHP;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class NamespaceSniff implements Sniff
{
    public function register()
    {
        return [
            T_CATCH,
        ];
    }

    public function process(File $phpcsFile, $stackPtr)
    {
        if ($phpcsFile->findNext(T_NAMESPACE, 0) === false) {
            return;
        }

        $tokens = $phpcsFile->getTokens();

        $endOfTryStatement = $phpcsFile->findEndOfStatement($stackPtr);

        $posOfCatchVariable = $phpcsFile->findNext(T_VARIABLE, $stackPtr, $endOfTryStatement);

        $posOfExceptionClassName = $phpcsFile->findNext(T_STRING, $stackPtr, $posOfCatchVariable);

        $posOfNsSeparator = $phpcsFile->findNext(T_NS_SEPARATOR, $stackPtr, $posOfExceptionClassName);

        if ($posOfNsSeparator === false) {
            $exceptionClassName = trim($tokens[$posOfExceptionClassName]['content']);
            $posOfClassInUse = $phpcsFile->findNext(T_STRING, 0, $stackPtr, false, $exceptionClassName);
            if ($posOfClassInUse === false || $tokens[$posOfClassInUse]['level'] != 0) {
                $phpcsFile->addError(
                    'Namespace for "' . $exceptionClassName . '" class is not specified.',
                    $posOfExceptionClassName,
                    'NamespaceError'
                );
            }
        }
    }
}
