<?php

declare(strict_types=1);

namespace HotelPlex\Application\Service;

interface Logger
{
    /**
     * @param string $message
     */
    public function info(string $message): void;

    /**
     * @param string $message
     */
    public function warning(string $message): void;

    /**
     * @param string $message
     */
    public function error(string $message): void;
}
