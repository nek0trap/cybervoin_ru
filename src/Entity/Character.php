<?php

namespace App\Entity;

use App\Repository\CharacterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CharacterRepository::class)
 * @ORM\Table(name="`character`")
 */
class Character
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
    private $health;

    /**
     * @ORM\Column(type="json")
     */
    private $skills = [];

    /**
     * @ORM\Column(type="json")
     */
    private $armor = [];

    /**
     * @ORM\Column(type="json")
     */
    private $weapons = [];

    /**
     * @ORM\Column(type="text")
     */
    private $bio;

    /**
     * @ORM\Column(type="json")
     */
    private $inventory = [];

    /**
     * @ORM\Column(type="json")
     */
    private $stats = [];

    /**
     * @ORM\Column(type="integer")
     */
    private $wounded;

    /**
     * @ORM\Column(type="integer")
     */
    private $deathsave;

    /**
     * @ORM\Column(type="integer")
     */
    private $dateCreateChar;

    /**
     * @ORM\Column(type="integer")
     */
    private $author;

    /**
     * @ORM\Column(type="text", nullable=true))
     */
    private $urlAvatar;

    private $weaponTmp;

    protected $weaponsArray;

    public function __construct()
    {
        $this->weaponsArray = new ArrayCollection();
    }


    public function getGuns(): ArrayCollection
    {
        if (isset($this->weaponsArray))
        {
            $this->setWeapons((array)$this->weaponsArray);
        }
        return $this->weaponsArray;
    }

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

    public function getHealth(): ?int
    {
        return $this->health;
    }

    public function setHealth(int $health): self
    {
        $this->health = $health;

        return $this;
    }

    public function getSkills(): ?array
    {
        return $this->skills;
    }

    public function setSkills(array $skills): self
    {
        $this->skills = $skills;

        return $this;
    }

    public function getArmor(): ?array
    {
        return $this->armor;
    }

    public function setArmor(array $armor): self
    {
        $this->armor = $armor;

        return $this;
    }

    public function getWeapons(): ?array
    {
        return $this->weapons;
    }

    public function setWeapons(array $weapons): self
    {
        $this->weapons = $weapons;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(string $bio): self
    {
        $this->bio = $bio;

        return $this;
    }

    public function getInventory(): ?array
    {
        return $this->inventory;
    }

    public function setInventory(array $inventory): self
    {
        $this->inventory = $inventory;

        return $this;
    }

    public function getStats(): ?array
    {
        return $this->stats;
    }

    public function setStats(StatChar $st): self
    {
        $stats = $st->getStats();
        $this->stats = $stats;

        return $this;
    }

    public function getWounded(): ?int
    {
        return $this->wounded;
    }

    public function setWounded(int $wounded): self
    {
        $this->wounded = $wounded;

        return $this;
    }

    public function getDeathsave(): ?int
    {
        return $this->deathsave;
    }

    public function setDeathsave(int $deathsave): self
    {
        $this->deathsave = $deathsave;

        return $this;
    }

    public function getDateCreateChar(): ?int
    {
        return $this->dateCreateChar;
    }

    public function setDateCreateChar(int $dateCreateChar): self
    {
        $this->dateCreateChar = $dateCreateChar;

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

    public function setWeapon(Weapon $weapon = null)
    {
        $dmg = $weapon->getDamage();
        $name = $weapon->getName();
        $tmpArr = $this->getWeapons();
        $tmpArr[] = [$name => $dmg];
        $this->setWeapons($tmpArr);

    }

    public function getWeapon()
    {
        return $this->weaponTmp;
    }

    public function setURLAvatar(string $url): self
    {
        $this->urlAvatar = $url;
        return $this;
    }

    public function getURLAvatar(): ?string
    {
        return $this->urlAvatar;
    }
}
