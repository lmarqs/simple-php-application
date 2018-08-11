<?php

namespace lmarqs\Spa\Core;

/**
 * Class Logger
 * @package lmarqs\Spa\Core
 *
 * @method void e(string $category, string $message) write error message.
 * @method void w(string $category, string $message) write warning message.
 * @method void i(string $category, string $message) write info message.
 * @method void d(string $category, string $message) write debug message.
 */
class Logger
{
    use SingletonTrait;

    const LEVEL_ERROR = 'ERROR';
    const LEVEL_WARNING = 'WARNING';
    const LEVEL_INFO = 'INFO';
    const LEVEL_DEBUG = 'DEBUG';

    private $targetFile;
    private $level;
    private $dateFormat = 'Y-m-d H:i:s';
    private $lineFormat = "[{date}] - {level} - {category} - {message}\n";

    public function __construct()
    {
        $this->targetFile = implode(DIRECTORY_SEPARATOR, ['', 'logs', 'application.log']);

        $logDir = dirname($this->targetFile);

        if (!is_dir($logDir)) {
            throw new Exception("Log dir '{$logDir}' not found.");
        }

        if (!is_writable($logDir)) {
            throw new Exception("Log dir '{$logDir}' not writable.");
        }

        $this->writeToFile("\n");
    }

    private function write($category, $message, $level)
    {
        $line = strtr($this->lineFormat, [
            '{date}' => date("Y-m-d H:i:s"),
            '{level}' => $level,
            '{category}' => $category,
            '{message}' => $message,
        ]);

        $this->writeToFile($line);
    }

    public function i($category, $message)
    {
        $this->write($category, $message, self::LEVEL_INFO);

    }

    public function e($category, $message)
    {
        $this->write($category, $message, self::LEVEL_ERROR);
    }

    public function w($category, $message)
    {
        $this->write($category, $message, self::LEVEL_WARNING);
    }

    public function d($category, $message)
    {
        $this->write($category, $message, self::LEVEL_DEBUG);
    }

    private function writeToFile($line)
    {
        error_log($line, 3, $this->targetFile);
    }
}
