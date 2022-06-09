<?php

namespace App\Entity;

use App\Repository\GameBoardRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * @ORM\Entity(repositoryClass=GameBoardRepository::class)
 */
class GameBoard
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $charactersArray = [];

    /**
     * @ORM\Column(type="integer")
     */
    protected $lineLength;

    /**
     * @ORM\Column(type="text")
     */
    protected $board;

    /**
     * @param $linelenght
     */
    public function __construct()
    {
        $this->lineLength = 24;
    }

    /**
     * Return id board
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }



    /**
     * Return line lenght board
     * @return int|null
     */
    public function getLineLenght(): ?int
    {
        return $this->lineLength;
    }

    /**
     * @param mixed $lineLength
     */
    public function setLineLength($lineLength): void
    {
        $this->lineLength = $lineLength;
    }



    /**
     * Return board like as string
     * @return string
     */
    public function getBoard(): ?string
    {
        return $this->board;
    }

    /**
     * @param mixed $board
     */
    public function setBoard($board): void
    {
        $this->board = $board;
    }

    /**
     * @return array
     */
    public function getCharacters(): array
    {
        if (isset($this->charactersArray))
        {
            $this->setCharactersArray($this->charactersArray);
        }
        return $this->charactersArray;
    }

    /**
     * @param array $charactersArray
     */
    public function setCharactersArray(array $charactersArray): void
    {
        $this->charactersArray = $charactersArray;
    }
    /**
     * @param bool $isAvailable
     */
    public function setIsAvailable(bool $isAvailable = false): void
    {
        $this->isAvailable = $isAvailable;
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
}