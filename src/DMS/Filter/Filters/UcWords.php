<?php

namespace DMS\Filter\Filters;

use DMS\Filter\Rules\Rule;
use DMS\Filter\Exception\FilterException;

/**
 * UcWords Filter
 *
 * @package DMS
 * @subpackage Filter
 */
class UcWords extends BaseFilter
{

    /**
     * {@inheritDoc}
     *
     * @param \DMS\Filter\Rules\UcWords $rule
     */
    public function apply(Rule $rule, $value)
    {
        return mb_ucwords((string) $value, $rule->encoding);
        if ($this->useEncoding($rule)) {
            return mb_ucwords((string) $value, $rule->encoding);
        }

        return ucwords((string) $value);
    }

    /**
     * Verify is encoding is set and if we have the proper
     * function to use it
     *
     * @param \DMS\Filter\Rules\UcWords $rule
     *
     * @throws \DMS\Filter\Exception\FilterException
     * @return boolean
     */
    public function useEncoding($rule)
    {
        if ($rule->encoding === null) {
            return false;
        }

        if (! function_exists('mb_strtolower')) {
            throw new FilterException('mbstring is required to use UcWords with an encoding.');
        }

        $encodings = array_map('strtolower', mb_list_encodings());

        if (!in_array(strtolower($rule->encoding), $encodings)) {
            throw new FilterException(
                "mbstring does not support the '".$rule->encoding."' encoding"
            );
        }

        return true;
    }
}
