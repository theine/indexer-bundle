<?php
/**
 * phlexible
 *
 * @copyright 2007-2013 brainbits GmbH (http://www.brainbits.net)
 * @license   proprietary
 */

namespace Phlexible\IndexerComponent\Result\Sorter;

use Phlexible\IndexerComponent\Document\DocumentInterface;

/**
 * Reverse field sorter
 *
 * @author Phillip Look <pl@brainbits.net>
 */
class FieldReverseSorter extends FieldSorter
{
    protected function compare(DocumentInterface $a, DocumentInterface $b)
    {
	    return -1 * parent::compare($a, $b);
    }
}