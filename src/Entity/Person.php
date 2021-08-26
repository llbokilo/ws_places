<?php

namespace App\Entity;

use App\Repository\PersonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PersonRepository::class)
 */
class Person
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("person:read")
     * @Groups("place:read")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("person:read")
     * @Groups("place:read")
     */
    private $firstname;

    /**
     * @ORM\ManyToMany(targetEntity=Place::class, inversedBy="likedby")
     * @Groups("person:read")
     */
    private $placesliked;

    public function __construct()
    {
        $this->placesliked = new ArrayCollection();
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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return Collection|Place[]
     */
    public function getPlacesliked(): Collection
    {
        return $this->placesliked;
    }

    public function addPlacesliked(Place $placesliked): self
    {
        if (!$this->placesliked->contains($placesliked)) {
            $this->placesliked[] = $placesliked;
        }

        return $this;
    }

    public function removePlacesliked(Place $placesliked): self
    {
        $this->placesliked->removeElement($placesliked);

        return $this;
    }

}
