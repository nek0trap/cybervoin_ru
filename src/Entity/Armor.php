<?php

namespace App\Entity;

use App\Repository\ArmorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArmorRepository::class)
 */
class Armor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $armorLabel;

    /**
     * @ORM\Column(type="integer")
     */
    private $armorHeadValue;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $armorHeadLabel;

    /**
     * @ORM\Column(type="integer")
     */
    private $armorBodyValue;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $armorBodyLabel;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getArmorLabel()
    {
        return $this->armorLabel;
    }

    /**
     * @param mixed $armorLabel
     */
    public function setArmorLabel($armorLabel): void
    {
        $this->armorLabel = $armorLabel;
    }

    /**
     * @return mixed
     */
    public function getArmorHeadValue()
    {
        return $this->armorHeadValue;
    }

    /**
     * @param mixed $armorHeadValue
     */
    public function setArmorHeadValue($armorHeadValue): void
    {
        $this->armorHeadValue = $armorHeadValue;
    }

    /**
     * @return mixed
     */
    public function getArmorHeadLabel()
    {
        return $this->armorHeadLabel;
    }

    /**
     * @param mixed $armorHeadLabel
     */
    public function setArmorHeadLabel($armorHeadLabel): void
    {
        $this->armorHeadLabel = $armorHeadLabel;
    }

    /**
     * @return mixed
     */
    public function getArmorBodyValue()
    {
        return $this->armorBodyValue;
    }

    /**
     * @param mixed $armorBodyValue
     */
    public function setArmorBodyValue($armorBodyValue): void
    {
        $this->armorBodyValue = $armorBodyValue;
    }

    /**
     * @return mixed
     */
    public function getArmorBodyLabel()
    {
        return $this->armorBodyLabel;
    }

    /**
     * @param mixed $armorBodyLabel
     */
    public function setArmorBodyLabel($armorBodyLabel): void
    {
        $this->armorBodyLabel = $armorBodyLabel;
    }


}
