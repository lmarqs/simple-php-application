<?php

namespace lmarqs\Spa\Middleware;

class Response
{

    const METHOD_GET = 'METHOD_GET';
    const METHOD_POST = 'METHOD_POST';
    const METHOD_PUT = 'METHOD_PUT';
    const METHOD_DELETE = 'METHOD_DELETE';

    private $content = '';
    private $headers = [];
    private $sent = false;

    public function write($content)
    {
        $this->content .= $content . "\n";
        return $this;
    }

    public function setHeader($header)
    {
        $this->headers[] = $header;
    }

    public function send($code = 200)
    {
        if ($this->sent) {
            throw new \Exception();
        }

        $this->sent = true;

        header('HTTP/1.1 ' . $code, true, $code);

        foreach ($this->headers as $header) {
            header($header);
        }

        echo $this->content;
    }
}
