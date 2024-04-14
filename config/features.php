<?php
use IngeniozIT\Edict\Container;

use function IngeniozIT\Edict\value;

/** @var Container $container */

// Set this value to true to enable the "awesome feature"
$container->set('my_awesome_feature_flag', value(false));