<?php

declare(strict_types=1);

namespace HotelPlex\Application\Presenter\Auth;

use HotelPlex\Application\Presenter\Presenter;

class TokenPresenter implements Presenter
{
    /**
     * @var string|null
     */
    private $token;

    /**
     * @param string $token
     * @return TokenPresenter
     */
    public function write(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return string|null
     */
    public function read()
    {
        return $this->token;
    }
}
