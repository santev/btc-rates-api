<?php

namespace App\Entity;

use App\Repository\QuotesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuotesRepository::class)
 */
class Quotes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $cmc_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=8)
     */
    private $symbol;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="datetimetz")
     */
    private $last_updated;

    /**
     * @ORM\Column(type="decimal", precision=65, scale=21)
     */
    private $BTC_price;

    /**
     * @ORM\Column(type="datetimetz")
     */
    private $price_last_updated;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCmcId(): ?int
    {
        return $this->cmc_id;
    }

    public function setCmcId(int $cmc_id): self
    {
        $this->cmc_id = $cmc_id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getSymbol(): ?string
    {
        return $this->symbol;
    }

    public function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getLastUpdated(): ?\DateTimeInterface
    {
        return $this->last_updated;
    }

    public function setLastUpdated(\DateTimeInterface $last_updated): self
    {
        $this->last_updated = $last_updated;

        return $this;
    }

    public function getBTCPrice(): ?string
    {
        return $this->BTC_price;
    }

    public function setBTCPrice(string $BTC_price): self
    {
        $this->BTC_price = $BTC_price;

        return $this;
    }

    public function getPriceLastUpdated(): ?\DateTimeInterface
    {
        return $this->price_last_updated;
    }

    public function setPriceLastUpdated(\DateTimeInterface $price_last_updated): self
    {
        $this->price_last_updated = $price_last_updated;

        return $this;
    }
}
