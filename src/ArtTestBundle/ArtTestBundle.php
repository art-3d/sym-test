<?php

namespace ArtTestBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ArtTestBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
