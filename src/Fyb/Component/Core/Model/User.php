<?php

namespace Fyb\Component\Core\Model;

use Fyb\Component\Store\Model\Store;
use Sylius\Component\Core\Model\User as BaseUser;

class User extends BaseUser
{
    /** @var  Store */
    protected $store;

    /**
     * @return Store
     */
    public function getStore()
    {
        return $this->store;
    }

    /**
     * @param Store $store
     */
    public function setStore($store)
    {
        $this->store = $store;
    }

}
