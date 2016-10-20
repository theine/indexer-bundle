<?php

/*
 * This file is part of the phlexible indexer package.
 *
 * (c) Stephan Wentz <sw@brainbits.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Phlexible\Bundle\IndexerBundle\Storage;

/**
 * Commitable interface
 *
 * @author Stephan Wentz <sw@brainbits.net>
 */
interface Commitable
{
    /**
     * Commit index
     */
    public function commit();
}
