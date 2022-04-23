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
     * @ORM\Column(type="integer")
     */
    protected $linelenght;

    /**
     * @ORM\Column(type="string", length=255)
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
     * Return board like as string
     * @return string
     */
    public function getBoard(): ?string
    {
        return $this->board;
    }

    public function isAvailable(): Boolean
    {
        return $this->isAvailable;
    }
}