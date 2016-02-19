<?php

namespace Fyb\Component\Store\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Fyb\Component\Core\Model\Product;
use Sylius\Component\Core\Model\User;
use Sylius\Component\Resource\Model\ResourceInterface;

class Store implements ResourceInterface
{
    /** @var  integer */
    protected $id;
    /** @var  User */
    protected $user;
    /** @var  Product[]|ArrayCollection */
    protected $products;
    /** @var string  */
    protected $code;
    /** @var  string */
    protected $name;
    /** @var  string */
    protected $address;
    /** @var  string */
    protected $geoloc;
    /** @var  boolean */
    protected $enabled;
    /** @var  \DateTime */
    protected $createdAt;
    /** @var  \DateTime */
    protected $updatedAt;

    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getGeoloc()
    {
        return $this->geoloc;
    }

    /**
     * @param string $geoloc
     */
    public function setGeoloc($geoloc)
    {
        $this->geoloc = $geoloc;
    }

    /**
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param boolean $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

}

