<?php

use Magento\Framework\Component\ComponentRegistrar;

$registrar = new ComponentRegistrar();

if ($registrar->getPath(ComponentRegistrar::MODULE, 'Training_Dependency') === null) {
    ComponentRegistrar::register(ComponentRegistrar::MODULE, 'Training_Dependency', __DIR__);
}
