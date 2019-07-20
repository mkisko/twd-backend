<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LayoutRepository")
 */
class Layout
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"point_show", "route_show", "route_create"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"point_show", "route_show"})
     */
    private $name;

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

    public function __toString()
    {
        return $this->getName() ?? '';
    }
}
