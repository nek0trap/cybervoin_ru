<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\Column(type="string", length=255)
     */
    private $gameadmin;

    /**
     * @ORM\Column(type="json")
     */
    private $gameBoard;

    protected $gameboardForm;

    /**
     * @param $gameboardForm
     */
    public function __construct()
    {
        $this->gameboardForm = new ArrayCollection();
    }

    public function getGameboardForm(): ArrayCollection
    {
        if (isset($this->gameboardForm[0]))
        {
            $this->setGameboard($this->gameboardForm[0]);
        }
        return $this->gameboardForm;
    }

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

    public function getGameadmin(): ?int
    {
        return $this->gameadmin;
    }

    public function setGameadmin(int $gameadmin): self
    {
        $this->gameadmin = $gameadmin;

        return $this;
    }

    public function getGameboard(): ?string
    {
        return $this->gameBoard;
    }

    public function setGameboard(GameBoard $gb): self
    {
        $this->gameBoard = $gb->getBoard();
        return $this;
    }
}
