<?php

namespace EG\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class EGUserBundle extends Bundle
{
    public function getParent()
    {
        return "FOSUserBundle";
    }
}
