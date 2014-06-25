<?php
/**
 * phlexible
 *
 * @copyright 2007-2013 brainbits GmbH (http://www.brainbits.net)
 * @license   proprietary
 */

namespace Phlexible\Bundle\IndexerBundle\Storage;

/**
 * Optimizable interface
 *
 * @author Marco Fischer <mf@brainbits.net>
 */
interface Optimizable
{
    /**
     * Optimize index
     *
     * @return mixed
     */
    public function optimize();
}