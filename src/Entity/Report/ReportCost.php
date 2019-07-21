<?php

namespace App\Entity\Report;

use App\Helper\ReportInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Report\ReportCostRepository")
 */
class ReportCost implements ReportInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $cost;

    /**
     * @ORM\Column(type="integer")
     */
    private $dateTime;

    public function __construct()
    {
        $this->setDateTime(time());
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDateTime(): int
    {
        return $this->dateTime;
    }

    public function setDateTime(int $dateTime): self
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    public function getValue(): float
    {
        return $this->getCost();
    }


}
