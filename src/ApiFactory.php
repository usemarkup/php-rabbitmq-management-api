<?php

namespace Markup\RabbitMq;

use function GuzzleHttp\uri_template;
use Markup\RabbitMq\ManagementApi\Api;
use Markup\RabbitMq\ManagementApi\Client as RabbitMqApiClient;

/**
 * Factory class for API Endpoints.
 * Returns Api classes for use in fluent interface
 */
class ApiFactory
{
    /**
     * @var RabbitMqApiClient
     */
    private $client;

    /**
     * @param RabbitMqApiClient $client
     */
    public function __construct(RabbitMqApiClient $client)
    {
        $this->client = $client;
    }

    /**
     * Declares a test queue, then publishes and consumes a message. Intended for use by monitoring tools. If
     * everything is working correctly, will return HTTP status 200 with body:
     *
     * {"status":"ok"}
     *
     * Note: the test queue will not be deleted (to to prevent queue churn if this is repeatedly pinged).
     *
     * @param  string $vhost
     * @return array
     */
    public function alivenessTest($vhost)
    {
        return $this->client->send(uri_template('/api/aliveness-test/{vhost}', ['vhost' => $vhost]));
    }

    /**
     * @return Api\Overview
     */
    public function overview()
    {
        return new Api\Overview($this->client);
    }

    /**
     * @return Api\Extension
     */
    public function extensions()
    {
        return new Api\Extension($this->client);
    }

    /**
     * @return Api\Definition
     */
    public function definitions()
    {
        return new Api\Definition($this->client);
    }

    /**
     * @return Api\Connection
     */
    public function connections()
    {
        return new Api\Connection($this->client);
    }

    /**
     * @return Api\Channel
     */
    public function channels()
    {
        return new Api\Channel($this->client);
    }

    /**
     * @return Api\Exchange
     */
    public function exchanges()
    {
        return new Api\Exchange($this->client);
    }

    /**
     * @return Api\Queue
     */
    public function queues()
    {
        return new Api\Queue($this->client);
    }

    /**
     * @return Api\Vhost
     */
    public function vhosts()
    {
        return new Api\Vhost($this->client);
    }

    /**
     * @return Api\Binding
     */
    public function bindings()
    {
        return new Api\Binding($this->client);
    }

    /**
     * @return Api\User
     */
    public function users()
    {
        return new Api\User($this->client);
    }

    /**
     * @return Api\Permission
     */
    public function permissions()
    {
        return new Api\Permission($this->client);
    }

    /**
     * @return Api\Parameter
     */
    public function parameters()
    {
        return new Api\Parameter($this->client);
    }

    /**
     * @return Api\Policy
     */
    public function policies()
    {
        return new Api\Policy($this->client);
    }

    /**
     * @return Api\WhoAmI
     */
    public function whoami()
    {
        return new Api\WhoAmI($this->client);
    }
}
