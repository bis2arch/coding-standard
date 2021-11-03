<?php
namespace Bis2arch\Magento\v1\Sniffs\Security;

use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\ForbiddenFunctionsSniff as GenericForbiddenFunctionsSniff;

class ForbiddenFunctionSniff extends GenericForbiddenFunctionsSniff
{
    protected $patternMatch = true;
}
