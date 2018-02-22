<?php
/**
 *  PHP Version 5
 *
 * @category    Amazon
 * @package     MarketplaceWebServiceProducts
 * @copyright   Copyright 2008-2012 Amazon.com, Inc. or its affiliates. All Rights Reserved.
 * @link        http://aws.amazon.com
 * @license     http://aws.amazon.com/apache2.0  Apache License, Version 2.0
 * @version     2011-10-01
 */

/*******************************************************************************
 *
 *  Marketplace Web Service Products PHP5 Library
 *
 */
class MarketplaceWebService_Model_ResponseHeaderMetadata
{

    const REQUEST_ID = 'x-mws-request-id';
    const RESPONSE_CONTEXT = 'x-mws-response-context';
    const TIMESTAMP = 'x-mws-timestamp';
    const H_QUOTA_MAX = 'x-mws-quota-max';
    const H_QUOTA_REMAINING = 'x-mws-quota-remaining';
    const H_QUOTA_RESETS_ON = 'x-mws-quota-resetsOn';

    private $metadata = array();

    /**
     * MarketplaceWebService_Model_ResponseHeaderMetadata constructor.
     * @param null $requestId
     * @param null $responseContext
     * @param null $timestamp
     * @param array $customHeaders
     */
    public function __construct($requestId = null, $responseContext = null, $timestamp = null, array $customHeaders = [])
    {
        $this->metadata[self::REQUEST_ID] = $requestId;
        $this->metadata[self::RESPONSE_CONTEXT] = $responseContext;
        $this->metadata[self::TIMESTAMP] = $timestamp;

        foreach ($customHeaders as $customerHeaderName => $customHeaderValue) {
            if (in_array($customerHeaderName, [self::REQUEST_ID, self::RESPONSE_CONTEXT, self::TIMESTAMP])) {
                continue;
            }

            $this->metadata[$customerHeaderName] = $customHeaderValue;
        }
    }


    public function getRequestId()
    {
        return $this->metadata[self::REQUEST_ID];
    }

    public function getResponseContext()
    {
        return $this->metadata[self::RESPONSE_CONTEXT];
    }

    public function getTimestamp()
    {
        return $this->metadata[self::TIMESTAMP];
    }

    /**
     * @return float
     */
    public function getQuotaMax()
    {
        if (!$this->exists(self::H_QUOTA_MAX)) {
            return;
        }

        return (float)$this->metadata[self::H_QUOTA_MAX];
    }

    /**
     * @return float
     */
    public function getQuotaRemaining()
    {
        if (!$this->exists(self::H_QUOTA_REMAINING)) {
            return;
        }

        return (float)$this->metadata[self::H_QUOTA_REMAINING];
    }

    /**
     * @return \DateTime|void
     */
    public function getQuotaResetsOn()
    {
        if (!$this->exists(self::H_QUOTA_RESETS_ON)) {
            return;
        }

        return new \DateTime($this->metadata[self::H_QUOTA_RESETS_ON]);
    }

    /**
     * @param string $headerName
     * @return string|void
     */
    public function exists($headerName)
    {
        if (!array_key_exists($headerName, $this->metadata)) {
            return false;
        }

        return true;
    }

    /**
     * @param string $headerName
     * @return string|void
     */
    public function getRawValue($headerName)
    {
        if (!array_key_exists($headerName, $this->metadata)) {
            return;
        }

        return $this->metadata[$headerName];
    }

    public function __toString()
    {
        $result = '';

        foreach ($this->metadata as $headerName => $headerValue) {
            $result += "$headerName: $headerValue, ";
        }

        return rtrim(', ', $result);
    }
}
