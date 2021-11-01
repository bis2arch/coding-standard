<?php
namespace Bis2arch\Magento\v1\Sniffs\Classes;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class ObjectInstantiationSniff implements Sniff
{
    protected $disallowedClassPrefixes = [
        'Mage_',
        'Enterprise_',
    ];

    public function register()
    {
        return [
            T_NEW,
        ];
    }

    public function process(File $phpcsFile, $stackPtr)
    {
        $next = $phpcsFile->findNext(T_STRING, $stackPtr + 1);
        $className = $phpcsFile->getTokens()[$next]['content'];
        if (preg_match('/^(' . implode('|', $this->disallowedClassPrefixes) . ')/i', $className)) {
            $phpcsFile->addWarning(
                'Direct object instantiation (class %s) is discouraged in Magento.',
                $stackPtr,
                'DirectInstantiation',
                [$className]
            );
        }
    }
}
