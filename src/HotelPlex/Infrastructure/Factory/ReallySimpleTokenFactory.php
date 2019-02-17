<?php

declare(strict_types=1);

namespace HotelPlex\Infrastructure\Factory;

use HotelPlex\Domain\Entity\Provider\Provider;
use HotelPlex\Domain\Entity\User\User;
use HotelPlex\Domain\Factory\Auth\TokenFactory;
use ReallySimpleJWT\Build;
use ReallySimpleJWT\Exception\ValidateException;
use ReallySimpleJWT\Token;

final class ReallySimpleTokenFactory implements TokenFactory
{
    const DEFAULT_ISSUER = 'HotelPlex';

    /**
     * @var Build
     */
    private $builder;
    /**
     * @var string
     */
    private $secret;
    /**
     * @var int
     */
    private $expiration;
    /**
     * @var string
     */
    private $issuer;

    /**
     * @param string $secret
     * @param int $expiration
     * @param string $issuer
     */
    public function __construct(string $secret, int $expiration, string $issuer = self::DEFAULT_ISSUER)
    {
        $this->builder = Token::builder();
        $this->secret = $secret;
        $this->expiration = $expiration;
        $this->issuer = $issuer;
    }

    /**
     * @param User|Provider $userOrProvider
     * @return mixed
     * @throws ValidateException
     */
    public function build($userOrProvider): string
    {
        return $this->builder->setPayloadClaim('uuid', $userOrProvider->uuid()->value())
            ->setSecret($this->secret)
            ->setExpiration($this->expiration)
            ->setIssuer($this->issuer)
            ->build()
            ->getToken();
    }
}
