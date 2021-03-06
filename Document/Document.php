<?php

/*
 * This file is part of the phlexible indexer package.
 *
 * (c) Stephan Wentz <sw@brainbits.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Phlexible\Bundle\IndexerBundle\Document;

use Phlexible\Bundle\IndexerBundle\Exception\InvalidArgumentException;

/**
 * Document.
 *
 * @author Marco Fischer <mf@brainbits.net>
 */
abstract class Document implements DocumentInterface, Boostable
{
    /**
     * @var DocumentIdentity
     */
    private $identity;

    /**
     * @var int
     */
    private $relevance = 0;

    /**
     * @var float
     */
    private $boost = 1.0;

    /**
     * @var array
     */
    private $fields = array();

    /**
     * @var array
     */
    private $values = array();

    public function __construct()
    {
        $this->setField('_document_class', array('type' => self::TYPE_STRING, 'stored' => true, 'indexed' => false));
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        $output = 'Identity: '.(string) $this->getIdentity().PHP_EOL
            .'DocumentClass: '.$this->getDocumentClass().PHP_EOL
            .'Relevance: '.$this->getRelevance().PHP_EOL;

        foreach ($this->fields as $key => $config) {
            $output .= $key.': '.var_export($this->get($key), true).' (';

            $dummy = array();
            foreach ($config as $configKey => $configValue) {
                $dummy[] = $configKey.':'.$configValue;
            }

            $output .= implode(',', $dummy).')'.PHP_EOL;
        }

        return $output;
    }

    /**
     * {@inheritdoc}
     */
    public function setIdentity(DocumentIdentity $identity)
    {
        $this->identity = $identity;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getIdentity()
    {
        return $this->identity;
    }

    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return $this->values;
    }

    /**
     * {@inheritdoc}
     */
    public function setValues($values)
    {
        foreach ($values as $key => $value) {
            if ($key[0] === '_') {
                continue;
            }

            $this->set($key, $value);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function has($key)
    {
        return isset($this->values[$key]);
    }

    /**
     * {@inheritdoc}
     */
    public function get($key)
    {
        if (!$this->hasField($key)) {
            throw new InvalidArgumentException("Unknown field $key");
        }

        if (!$this->has($key)) {
            return null;
        }

        return $this->values[$key];
    }

    /**
     * {@inheritdoc}
     */
    public function set($key, $value)
    {
        if (!$this->hasField($key)) {
            throw new InvalidArgumentException("Unknown field $key");
        }

        if (isset($this->fields[$key][self::CONFIG_MULTIVALUE])) {
            $value = (array) $value;
        }

        $this->values[$key] = $value;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function hasField($key)
    {
        return isset($this->fields[$key]);
    }

    /**
     * {@inheritdoc}
     */
    public function setFields(array $fields)
    {
        $this->setField('_document_class', array('type' => self::TYPE_STRING, 'stored' => true, 'indexed' => false));

        foreach ($fields as $key => $config) {
            $this->setField($key, $config);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * {@inheritdoc}
     */
    public function setField($key, array $config = array())
    {
        $this->fields[$key] = $config;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getField($key)
    {
        return $this->fields[$key];
    }

    /**
     * {@inheritdoc}
     */
    public function removeField($key)
    {
        unset($this->fields[$key], $this->values[$key]);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setBoost($boost)
    {
        $this->boost = (float) $boost;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBoost()
    {
        return (float) $this->boost;
    }

    /**
     * {@inheritdoc}
     */
    public function getDocumentClass()
    {
        return get_class($this);
    }

    /**
     * {@inheritdoc}
     */
    public function setRelevance($relevance)
    {
        $this->relevance = $relevance;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRelevance()
    {
        return $this->relevance;
    }
}
