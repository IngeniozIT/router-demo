<?php

declare(strict_types=1);

namespace App;

use Psr\Container\ContainerInterface;

class AwesomeFeatureIsEnabled
{
    public function __construct(private ContainerInterface $container)
    {
    }

    public function __invoke(): bool
    {
        return $this->container->get('my_awesome_feature_flag') === true;
    }
}