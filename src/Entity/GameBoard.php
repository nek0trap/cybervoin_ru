<?php

namespace App\Entity;

use App\Repository\GameBoardRepository;
use Doctrine\ORM\Mapping as ORM;

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
     * @Assert\NotBlank
     */
    protected $linelenght;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    protected $board;

    /**
     * @ORM\Column(type="boolean", nullable=false, options{"default" : 0})
     * @var boolean
     */
    protected $isAvaible;

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
    public function getBoard(): string
    {
        return $this->board;
    }
}
