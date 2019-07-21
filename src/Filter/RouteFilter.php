<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 21/07/2019
 * Time: 03:06
 */

namespace App\Filter;


use Symfony\Component\Serializer\Annotation\Groups;

class RouteFilter
{
    /** @var string|null */
    protected $ecologic;

    /** @var string|null */
    protected $trafficJam;

    /** @var string|null */
    protected $cost;

    /** @var string|null */
    protected $traffic;

    /** @var string|null */
    protected $priority;

    /**
     * @return null|string
     */
    public function getEcologic(): ?string
    {
        return $this->ecologic;
    }

    /**
     * @param null|string $ecologic
     */
    public function setEcologic(?string $ecologic): void
    {
        $this->ecologic = $ecologic;
    }

    /**
     * @return null|string
     */
    public function getTrafficJam(): ?string
    {
        return $this->trafficJam;
    }

    /**
     * @param null|string $trafficJam
     */
    public function setTrafficJam(?string $trafficJam): void
    {
        $this->trafficJam = $trafficJam;
    }

    /**
     * @return null|string
     */
    public function getCost(): ?string
    {
        return $this->cost;
    }

    /**
     * @param null|string $cost
     */
    public function setCost(?string $cost): void
    {
        $this->cost = $cost;
    }

    /**
     * @return null|string
     */
    public function getTraffic(): ?string
    {
        return $this->traffic;
    }

    /**
     * @param null|string $traffic
     */
    public function setTraffic(?string $traffic): void
    {
        $this->traffic = $traffic;
    }

    /**
     * @return null|string
     */
    public function getPriority(): ?string
    {
        return $this->priority;
    }

    /**
     * @param null|string $priority
     */
    public function setPriority(?string $priority): void
    {
        $this->priority = $priority;
    }
}
