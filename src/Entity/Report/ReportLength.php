<?php

namespace App\Entity\Report;

use App\Helper\ReportInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Report\ReportLengthRepository")
 */
class ReportLength implements ReportInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $dateTime;

    /**
     * @ORM\Column(type="float")
     */
    private $length;

    public function __construct()
    {
        $this->setDateTime(time());
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLength(): ?float
    {
        return $this->length;
    }

    public function setLength(float $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getValue(): float
    {
        return $this->getLength();
    }
}
