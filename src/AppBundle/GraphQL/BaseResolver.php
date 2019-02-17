<?php

declare(strict_types=1);

namespace App\GraphQL;

use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;
use Psr\Container\ContainerInterface;

abstract class BaseResolver implements ResolverInterface, AliasedInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param Argument $args
     * @return mixed
     */
    public abstract function resolve(Argument $args);

    /**
     * @return array
     */
    public static function getAliases()
    {
        return [
            'resolve' => get_called_class()
        ];
    }
}
