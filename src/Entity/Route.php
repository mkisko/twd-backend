<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RouteRepository")
 */
class Route
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"route_show", "point_show"})
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Point", inversedBy="routes",cascade={"persist"})
     * @Groups({"route_show", "route_create"})
     */
    private $points;

    /**
     * @ORM\Column(type="float")
     * @Groups({"route_show", "route_create"})
     */
    private $length;

    /**
     * @ORM\Column(type="float")
     * @Groups({"route_show", "route_create"})
     */
    private $cost;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"route_show", "route_create"})
     */
    private $priority;

    /**
     * @ORM\Column(type="float")
     * @Groups({"route_show", "route_create"})
     */
    private $traffic;

    public function __construct()
    {
        $this->points = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return Collection|Point[]
     */
    public function getPoints(): Collection
    {
        return $this->points;
    }

    public function addPoint(Point $point): self
    {
        if (!$this->points->contains($point)) {
            $this->points[] = $point;
        }

        return $this;
    }

    public function removePoint(Point $point): self
    {
        if ($this->points->contains($point)) {
            $this->points->removeElement($point);
        }

        return $this;
    }

    public function getLength(): ?float
    {
        return $this->length;
    }

    public function setLength(float $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getCost(): ?float
    {
        return $this->cost;
    }

    public function setCost(float $cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function getTraffic(): ?float
    {
        return $this->traffic;
    }

    public function setTraffic(float $traffic): self
    {
        $this->traffic = $traffic;

        return $this;
    }

    public function __toString()
    {
        return (string)$this->getId();
    }
}
