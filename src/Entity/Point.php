<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PointRepository")
 */
class Point
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"point_show", "route_show", "route_create"})
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     * @Groups({"point_show", "route_show"})
     */
    private $latitude;

    /**
     * @ORM\Column(type="float")
     * @Groups({"point_show", "route_show"})
     */
    private $longitude;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Route", mappedBy="points")
     * @Groups({"point_show"})
     */
    private $routes;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"point_show", "route_show"})
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Layout")
     * @Groups({"point_show", "route_show"})
     */
    private $layouts;

    public function __construct()
    {
        $this->routes = new ArrayCollection();
        $this->layouts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return Collection|Route[]
     */
    public function getRoutes(): Collection
    {
        return $this->routes;
    }

    public function addRoute(Route $route): self
    {
        if (!$this->routes->contains($route)) {
            $this->routes[] = $route;
            $route->addPoint($this);
        }

        return $this;
    }

    public function removeRoute(Route $route): self
    {
        if ($this->routes->contains($route)) {
            $this->routes->removeElement($route);
            $route->removePoint($this);
        }

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function __toString()
    {
        return $this->getLatitude().'-'.$this->getLongitude();
    }

    /**
     * @return Collection|Layout[]
     */
    public function getLayouts(): Collection
    {
        return $this->layouts;
    }

    public function addLayout(Layout $layout): self
    {
        if (!$this->layouts->contains($layout)) {
            $this->layouts[] = $layout;
        }

        return $this;
    }

    public function removeLayout(Layout $layout): self
    {
        if ($this->layouts->contains($layout)) {
            $this->layouts->removeElement($layout);
        }

        return $this;
    }
}
