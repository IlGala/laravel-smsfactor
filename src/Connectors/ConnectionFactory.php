<?php

/*
 * This file is part of Laravel SMSFactor.
 *
 * (c) Filippo Galante <filippo.galante@b-ground.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IlGala\LaravelSMSFactor\Connectors;

use InvalidArgumentException;

/**
 * This is the adapter connection factory class.
 *
 * @author Filippo Galante <filippo.galante@b-ground.com>
 */
class ConnectionFactory
{

    /**
     * Establish an adapter connection.
     *
     * @param array $config
     *
     * @return \DigitalOceanV2\Adapter\AdapterInterface
     */
    public function make(array $config)
    {
        return $this->createConnector($config)->connect($config);
    }

    /**
     * Create a connector instance based on the configuration.
     *
     * @param array $config
     *
     * @throws \InvalidArgumentException
     *
     * @return \GrahamCampbell\Manager\ConnectorInterface
     */
    public function createConnector(array $config)
    {
        if (!isset($config['driver'])) {
            throw new InvalidArgumentException('A driver must be specified.');
        }
        switch ($config['driver']) {
            case 'buzz':
                return new BuzzConnector();
            case 'guzzle':
                return new GuzzleConnector();
            case 'guzzlehttp':
                return new GuzzleHttpConnector();
        }
        throw new InvalidArgumentException("Unsupported driver [{$config['driver']}].");
    }
}