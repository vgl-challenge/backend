<?php

namespace App;
Class Product
{
  private $id = null;
  private $Name = null;
  private $price = null;


    /**
     * @return null
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return null
     */
    public function getName() : string
    {
        return $this->Name;
    }

    /**
     * @param null $Name
     */
    public function setName(string $Name)
    {
        $this->Name = $Name;
    }

    /**
     * @return null
     */
    public function getPrice() : float
    {
        return $this->price;
    }

    /**
     * @param null $price
     */
    public function setPrice(float $price) 
    {
        $this->price = $price;
    }



}
