<?php

namespace App\Entity;

use App\Repository\CharacterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Table(name="`character`")
 * @ORM\Entity(repositoryClass=CharacterRepository::class)
 */
class Character
{
    //region base field entity
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
    private $cyberware = [];

    /**
     * @ORM\Column(type="json")
     */
    private $gear = [];

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
    //endregion

    protected $weaponsArray;
    protected $armorArray;
    protected $cyberwareArray;
    protected $gearArray;


    public function __construct()
    {
        $this->cyberwareArray = new ArrayCollection();
        $this->gearArray = new ArrayCollection();
        $this->weaponsArray = new ArrayCollection();
        $this->armorArray = new ArrayCollection();
    }

    //region ArrayCollection method
    public function getGears(): ArrayCollection
    {
        if (isset($this->gearArray))
        {
            $this->setGear((array)$this->gearArray);
        }
        return $this->gearArray;
    }

    public function getCyberwares(): ArrayCollection
    {
        if (isset($this->cyberwareArray))
        {
            $this->setCyberware((array)$this->cyberwareArray);
        }
        return $this->cyberwareArray;
    }

    public function getArmors(): ArrayCollection
    {
        if (isset($this->armorArray))
        {
            $this->setArmor((array)$this->armorArray);
        }
        return $this->armorArray;
    }

    public function getGuns(): ArrayCollection
    {
        if (isset($this->weaponsArray))
        {
            $this->setWeapons((array)$this->weaponsArray);
        }
        return $this->weaponsArray;
    }

    //endregion

    //region getter and setter ArrayCollection
    /**
     * @return array
     */
    public function getCyberware(): array
    {
        return $this->cyberware;
    }

    /**
     * @param array $cyberware
     */
    public function setCyberware(array $cyberware): void
    {
        $this->cyberware = $cyberware;
    }

    /**
     * @return array
     */
    public function getGear(): array
    {
        return $this->gear;
    }

    /**
     * @param array $gear
     */
    public function setGear(array $gear): void
    {
        $this->gear = $gear;
    }
    //endregion

    //region ArrayCollection setters for base setters!
    /*
    Методы вызывать можно и нужно только в тех местах, где гарантировано есть
    Значение в коллекциях, инчае краш.
    */
    public function setWeaponsArrayCollection(): self
    {
        $ac = $this->getGuns();
        $guns = array();
        foreach ($ac as $key => $value)
        {
            $guns[] = [$value->getName() => $value->getDamage()];
        }
        $this->setWeapons($guns);
        return $this;
    }

    public function setGearsArrayCollection(): self
    {
        $ac = $this->getGears();
        $gears = array();
        foreach ($ac as $key => $value)
        {
            $gears[] = [
                'name' => $value->getName(),
                'description' => $value->getDescription(),
            ];
        }
        $this->setGear($gears);
        return $this;
    }

    public function setCyberwaresArrayCollection(): self
    {
        $ac = $this->getCyberwares();
        $cyberwares = array();
        foreach ($ac as $value)
        {
            $cyberwares[] = [
                'name' => $value->getName(),
                'description' => $value->getDescription(),
            ];
        }
        $this->setCyberware($cyberwares);
        return $this;
    }

    public function setArmorsArrayCollection(): self
    {
        $ac = $this->getArmors();
        $armors = array();
        foreach ($ac as $value)
        {
            $armors[] = [
                'name' => $value->getName(),
                'body' => $value->getBody(),
                'head' => $value->getHead()
            ];
        }
        $this->setArmor($armors);
        return $this;
    }

    //endregion

    //region base getters and setters
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

    public function setSkills(CharacterSkillPreset $skills): self
    {
        $this->skills = $skills->getSkills();

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

    public function setStats(CharacterStatsPreset $st): self
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

    public function setURLAvatar(string $url): self
    {
        $this->urlAvatar = $url;
        return $this;
    }

    public function getURLAvatar(): ?string
    {
        return $this->urlAvatar;
    }
    //endregion

}
