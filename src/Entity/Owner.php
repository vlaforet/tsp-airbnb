<?php

namespace App\Entity;

use App\Repository\OwnerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OwnerRepository::class)
 */
class Owner
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $familyname;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity=Room::class, mappedBy="owner", orphanRemoval=true)
     */
    private $Rooms;

    public function __construct()
    {
        $this->Rooms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getFamilyname(): ?string
    {
        return $this->familyname;
    }

    public function setFamilyname(string $familyname): self
    {
        $this->familyname = $familyname;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection|Room[]
     */
    public function getRooms(): Collection
    {
        return $this->Rooms;
    }

    public function addRoom(Room $room): self
    {
        if (!$this->Rooms->contains($room)) {
            $this->Rooms[] = $room;
            $room->setOwner($this);
        }

        return $this;
    }

    public function removeRoom(Room $room): self
    {
        if ($this->Rooms->removeElement($room)) {
            // set the owning side to null (unless already changed)
            if ($room->getOwner() === $this) {
                $room->setOwner(null);
            }
        }

        return $this;
    }
}
