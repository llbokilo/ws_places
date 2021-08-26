<?php

namespace App\Entity;

use App\Repository\PlaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PlaceRepository::class)
 */
class Place
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
    private $adress;

    /**
     * @ORM\ManyToMany(targetEntity=Person::class, mappedBy="placesliked")
     * @Groups("place:read")
     */
    private $likedby;

    public function __construct()
    {
        $this->likedby = new ArrayCollection();
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

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * @return Collection|Person[]
     */
    public function getLikedby(): Collection
    {
        return $this->likedby;
    }

    public function addLikedby(Person $likedby): self
    {
        if (!$this->likedby->contains($likedby)) {
            $this->likedby[] = $likedby;
            $likedby->addPlacesliked($this);
        }

        return $this;
    }

    public function removeLikedby(Person $likedby): self
    {
        if ($this->likedby->removeElement($likedby)) {
            $likedby->removePlacesliked($this);
        }

        return $this;
    }

}
