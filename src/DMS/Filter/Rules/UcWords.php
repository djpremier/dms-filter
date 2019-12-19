<?php

namespace DMS\Filter\Rules;

/**
 * UcWords Rule
 *
 * @package DMS
 * @subpackage Filter
 *
 * @Annotation
 */
class UcWords extends Rule
{
    /**
     * Encoding to be used
     *
     * @var string
     */
    public $encoding = null;

    /**
     * {@inheritDoc}
     */
    public function getDefaultOption()
    {
        return 'encoding';
    }
}
