<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $author;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $characters = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $players = [];

    /**
     * @ORM\Column(type="integer")
     */
    private $gameadmin;

    /**
     * @ORM\Column(type="integer")
     */
    private $gameBoard;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
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

    public function getAuthor(): ?int
    {
        return $this->author;
    }

    public function setAuthor(int $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getCharacters(): ?array
    {
        return $this->characters;
    }

    public function setCharacters(?array $characters): self
    {
        $this->characters = $characters;

        return $this;
    }

    public function getPlayers(): ?array
    {
        return $this->players;
    }

    public function setPlayers(?array $players): self
    {
        $this->players = $players;

        return $this;
    }

    public function getGameadmin(): ?int
    {
        return $this->gameadmin;
    }

    public function setGameadmin(int $gameadmin): self
    {
        $this->gameadmin = $gameadmin;

        return $this;
    }
}
