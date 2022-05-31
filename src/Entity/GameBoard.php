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
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $charactersArray = [];

    /**
     * @ORM\Column(type="integer")
     */
    protected $linelenght;

    /**
     * @ORM\Column(type="text")
     */
    protected $board;

    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default" : 0})
     * @var boolean
     */
    protected $isAvailable;

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
        return $this->linelenght;
    }

    /**
     * @param mixed $linelenght
     */
    public function setLinelenght($linelenght): void
    {
        $this->linelenght = $linelenght;
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
    public function getCharactersArray(): array
    {
        return $this->charactersArray;
    }

    /**
     * @param array $charactersArray
     */
    public function setCharactersArray(array $charactersArray): void
    {
        $this->charactersArray = $charactersArray;
    }



    public function isAvailable(): Boolean
    {
        return $this->isAvailable;
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