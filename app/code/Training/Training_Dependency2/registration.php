<?php

use Magento\Framework\Component\ComponentRegistrar;

$registrar = new ComponentRegistrar();

if ($registrar->getPath(ComponentRegistrar::MODULE, 'Training_Dependency2') === null) {
    ComponentRegistrar::register(ComponentRegistrar::MODULE, 'Training_Dependency2', __DIR__);
}