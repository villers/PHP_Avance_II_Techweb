<?php

namespace Trello\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class TrelloUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
