<?php
namespace Ratchet\Server;
use GuzzleHttp\Psr7\Request;
use Ratchet\ConnectionInterface;
use React\Socket\ConnectionInterface as ReactConn;

/**
 * {@inheritdoc}
 */
class IoConnection implements ConnectionInterface {
    /**
     * @var \React\Socket\ConnectionInterface
     */
    protected $conn;

    public int|null $resourceId = null;

    public string|null $remoteAddress = null;

    public bool|null $httpHeadersReceived = null;

    public string|null $httpBuffer = null;

    public Request|null $httpRequest = null;

    public \stdClass|null $WebSocket = null;

    /**
     * @param \React\Socket\ConnectionInterface $conn
     */
    public function __construct(ReactConn $conn) {
        $this->conn = $conn;
    }

    /**
     * {@inheritdoc}
     */
    public function send($data) {
        $this->conn->write($data);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function close() {
        $this->conn->end();
    }
}
