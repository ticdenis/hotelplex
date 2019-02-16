<?php

declare(strict_types=1);

namespace HotelPlex\Application\Presenter;

final class TokenPresenter implements Presenter
{
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
