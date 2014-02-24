<?php
/**
 * phlexible
 *
 * @copyright 2007-2013 brainbits GmbH (http://www.brainbits.net)
 * @license   proprietary
 */

namespace Phlexible\IndexerComponent\Result;

use Phlexible\Identifier\Identifier;

/**
 * Result identifier
 *
 * @author Marco Fischer <mf@brainbits.net>
 */
class ResultIdentifier extends Identifier
{
    /**
     * Create a new indexer result identifier
     *
     * @param string $query
     */
    public function __construct($query)
    {
        parent::__construct('indexer_result', md5($query));
    }
}