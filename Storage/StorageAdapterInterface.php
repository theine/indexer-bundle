<?php
/**
 * phlexible
 *
 * @copyright 2007-2013 brainbits GmbH (http://www.brainbits.net)
 * @license   proprietary
 */

namespace Phlexible\IndexerComponent\Storage;
use Phlexible\IndexerComponent\Document\DocumentInterface;
use Phlexible\IndexerComponent\Query\QueryInterface;

/**
 * Storage adapter interface
 *
 * @author Marco Fischer <mf@brainbits.net>
 */
interface StorageAdapterInterface
{
    const PREFERENCE_DO_NOT_USE  = 0;
    const PREFERENCE_LOW         = 10;
    const PREFERENCE_HIGH        = 50;
    const PREFERENCE_FIRST_COICE = 100;

    /**
     * Return connection parameters as string
     *
     * @return string
     */
    public function getConnectionString();

    /**
     * Return document by identifier
     *
     * @param string $identifier
     * @return DocumentInterface
     */
    public function getByIdentifier($identifier);

    /**
     * Return documents by query
     *
     * @param QueryInterface $query
     * @return DocumentInterface[]
     */
    public function getByQuery(QueryInterface $query);

    /**
     * Return all documents
     *
     * @return array of MWF_Core_Indexer_Document_Interface
     */
    public function getAll();

    /**
     * Add document
     *
     * @param DocumentInterface $document
     */
    public function addDocument(DocumentInterface $document);

    /**
     * Update document
     *
     * @param DocumentInterface $document
     */
    public function updateDocument(DocumentInterface $document);

    /**
     * Remove document by identifier
     *
     * @param string $identifier
     */
    public function removeByIdentifier($identifier = null);

    /**
     * Remove documents by query
     *
     * @param QueryInterface $query
     */
    public function removeByQuery(QueryInterface $query);

    /**
     * Remove all documents
     */
    public function removeAll();

    /**
     * @return integer
     */
    public function getPreference();

    /**
     * @return string
     */
    public function getLabel();

    /**
     * @return string
     */
    public function getResultClass();

    /**
     * @return array
     */
    public function getAcceptQuery();

    /**
     * @return array
     */
    public function getAcceptStorage();

    /**
     * @return string
     */
    public function getId();

    /**
     * @return boolean
     */
    public function isHealthy();
}