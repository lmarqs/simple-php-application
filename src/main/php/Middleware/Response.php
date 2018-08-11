<?php

namespace lmarqs\Spa\Middleware;

class Response
{

    const METHOD_GET = 'METHOD_GET';
    const METHOD_POST = 'METHOD_POST';
    const METHOD_PUT = 'METHOD_PUT';
    const METHOD_DELETE = 'METHOD_DELETE';

    private $code;
    private $content;
    private $headers;

    /**
     * Response constructor.
     * @param int $code
     * @param string $content
     * @param array $headers
     */
    public function __construct($code = 200, $content = '', $headers = [])
    {
        $this->code = $code;
        $this->content = $content;
        $this->headers = $headers;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param int $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     * @param bool $append
     * @return array
     */
    public function setHeaders($headers, $append = true)
    {
        if ($append) {
            foreach ($headers as $header) {
                if (!in_array($header, $this->headers)) {
                    $this->headers[] = $header;
                }
            }
        } else {
            $this->headers = $headers;
        }
        return $this->headers;
    }

    public function send()
    {
        header('HTTP/1.1 ' . $this->code, true, $this->code);

        foreach ($this->headers as $header) {
            header($header);
        }

        echo $this->content;
    }
}
