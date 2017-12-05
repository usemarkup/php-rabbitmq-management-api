<?php

namespace Markup\RabbitMq\ManagementApi;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request;

/**
 * ManagementApi
 *
 * @author Richard Fullmer <richard.fullmer@opensoftdev.com>
 */
class Client
{
    /**
     * @var GuzzleClient
     */
    protected $client;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    const USERNAME_DEFAULT = 'guest';

    /**
     * @var string
     */
    const PASSWORD_DEFAULT = 'guest';

    /**
     * @var string
     */
    const BASEURL_DEFAULT = 'http://localhost:15672';

    public function __construct(
        $baseUrl = self::BASEURL_DEFAULT,
        $username = self::USERNAME_DEFAULT,
        $password = self::PASSWORD_DEFAULT
    ) {
        $this->client = new GuzzleClient(['base_uri' => $baseUrl]);
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @param  string|array          $endpoint Resource URI.
     * @param  string                $method
     * @param  array                 $headers  HTTP headers
     * @param  string|resource|array $body     Entity body of request (POST/PUT) or response (GET)
     * @return array
     */
    public function send($endpoint, $method = 'GET', $headers = [], $body = null)
    {
        if (null !== $body) {
            $body = json_encode($body);
        }
        if (in_array($method, ['PUT', 'POST', 'DELETE'])) {
            $headers['Content-Type'] = 'application/json';
        }

        $response = $this->client->send(new Request($method, $endpoint, $headers, $body));

        return json_decode($response->getBody(), true);
    }
}
