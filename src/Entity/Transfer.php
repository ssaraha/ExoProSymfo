<?php

namespace App\Entity;

use App\Repository\TransferRepository;
use Doctrine\ORM\Mapping as ORM;

use App\Entity\Traits\Timestampable;

/**
 * @ORM\Entity(repositoryClass=TransferRepository::class)
 */
class Transfer
{

    use Timestampable;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class, inversedBy="transfers")
     */
    private $player;

    /**
     * @ORM\ManyToOne(targetEntity=Season::class, inversedBy="transfers")
     */
    private $season;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $transfer;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity=Club::class, inversedBy="transfers")
     */
    private $from_club;

    /**
     * @ORM\ManyToOne(targetEntity=Club::class, inversedBy="transfers")
     */
    private $to_club;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function getSeason(): ?season
    {
        return $this->season;
    }

    public function setSeason(?season $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function getTransfer(): ?string
    {
        return $this->transfer;
    }

    public function setTransfer(string $transfer): self
    {
        $this->transfer = $transfer;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getFromClub(): ?Club
    {
        return $this->from_club;
    }

    public function setFromClub(?Club $from_club): self
    {
        $this->from_club = $from_club;

        return $this;
    }

    public function getToClub(): ?club
    {
        return $this->to_club;
    }

    public function setToClub(?club $to_club): self
    {
        $this->to_club = $to_club;

        return $this;
    }
}
