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

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\NationalProgram", inversedBy="routes")
     * @Groups({"route_show", "route_create"})
     */
    private $nationalPrograms;

    /**
     * @var float|null
     * @Groups({"route_show"})
     */
    private $efficiency;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"route_show", "route_create"})
     */
    private $trafficJam;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"route_show", "route_create"})
     */
    private $ecologic;

    public function __construct()
    {
        $this->points = new ArrayCollection();
        $this->nationalPrograms = new ArrayCollection();
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

    /**
     * @return Collection|NationalProgram[]
     */
    public function getNationalPrograms(): Collection
    {
        return $this->nationalPrograms;
    }

    public function addNationalProgram(NationalProgram $nationalProgram): self
    {
        if (!$this->nationalPrograms->contains($nationalProgram)) {
            $this->nationalPrograms[] = $nationalProgram;
        }

        return $this;
    }

    public function removeNationalProgram(NationalProgram $nationalProgram): self
    {
        if ($this->nationalPrograms->contains($nationalProgram)) {
            $this->nationalPrograms->removeElement($nationalProgram);
        }

        return $this;
    }

    public function getSumNationalProgram()
    {
        $sum = 0;
        foreach ($this->getNationalPrograms() as $item) {
            $sum += $item->getPriority();
        }
        return $sum;
    }

    /**
     * @return float|null
     */
    public function getEfficiency(): ?float
    {
        return $this->efficiency;
    }

    /**
     * @param float|null $efficiency
     */
    public function setEfficiency(?float $efficiency): void
    {
        $this->efficiency = $efficiency;
    }

    public function getTrafficJam(): ?float
    {
        return $this->trafficJam;
    }

    public function setTrafficJam(?float $trafficJam): self
    {
        $this->trafficJam = $trafficJam;

        return $this;
    }

    public function getEcologic(): ?float
    {
        return $this->ecologic;
    }

    public function setEcologic(?float $ecologic): self
    {
        $this->ecologic = $ecologic;

        return $this;
    }
}
