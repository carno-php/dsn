<?php
/**
 * Data Source Name
 * User: moyo
 * Date: 02/11/2017
 * Time: 3:41 PM
 */

namespace Carno\DSN;

class DSN
{
    /**
     * @var string
     */
    private $raw = null;

    /**
     * @var string
     */
    private $scheme = 'none';

    /**
     * @var string
     */
    private $host = 'localhost';

    /**
     * @var int
     */
    private $port = 0;

    /**
     * @var string
     */
    private $user = null;

    /**
     * @var string
     */
    private $pass = null;

    /**
     * @var string
     */
    private $path = null;

    /**
     * @var array
     */
    private $options = [];

    /**
     * DSN constructor.
     * @param string $dsn
     */
    public function __construct(string $dsn)
    {
        $this->raw = $dsn;

        if (false === strpos($dsn, '://')) {
            $dsn  = "{$this->scheme}://{$dsn}";
        }

        $parsed = parse_url($dsn);

        $this->scheme = $parsed['scheme'] ?? $this->scheme;

        $this->host = $parsed['host'] ?? $this->host;
        $this->port = $parsed['port'] ?? $this->port;

        $this->user = $parsed['user'] ?? $this->user;
        $this->pass = $parsed['pass'] ?? $this->pass;

        if (isset($parsed['path'])) {
            $this->path = substr($parsed['path'], 1);
        }

        if (isset($parsed['query'])) {
            foreach (explode('&', $parsed['query']) as $expr) {
                if (false === strpos($expr, '=')) {
                    [$key, $val] = [$expr, true];
                } else {
                    [$key, $val] = explode('=', $expr);
                }
                $this->options[$key] = $val;
            }
        }
    }

    /**
     * @return string
     */
    public function scheme() : string
    {
        return $this->scheme;
    }

    /**
     * @return string
     */
    public function host() : string
    {
        return $this->host;
    }

    /**
     * @return int
     */
    public function port() : int
    {
        return $this->port;
    }

    /**
     * @return string
     */
    public function user() : string
    {
        return $this->user ?? '';
    }

    /**
     * @return string
     */
    public function pass() : string
    {
        return $this->pass ?? '';
    }

    /**
     * @return string
     */
    public function path() : string
    {
        return $this->path ?? '/';
    }

    /**
     * @param string $key
     * @param null $default
     * @return mixed|null
     */
    public function option(string $key, $default = null)
    {
        return $this->options[$key] ?? $default;
    }
}
