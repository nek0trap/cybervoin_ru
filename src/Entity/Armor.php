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
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $head;

    /**
     * @ORM\Column(type="integer")
     */
    private $body;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getHead(): ?int
    {
        return $this->head;
    }

    public function setHead(int $head): self
    {
        $this->head = $head;

        return $this;
    }

    public function getBody(): ?int
    {
        return $this->body;
    }

    public function setBody(int $body): self
    {
        $this->body = $body;

        return $this;
    }
}
