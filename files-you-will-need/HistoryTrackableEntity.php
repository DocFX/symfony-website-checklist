<?php

declare(strict_types = 1);

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait HistoryTrackableEntity.
 */
trait HistoryTrackableEntity
{
    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private DateTime $created;

    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private DateTime $updated;

    /**
     * @return DateTime|null
     */
    public function getCreated(): ?DateTime
    {
        return $this->created ?? new DateTime();
    }

    /**
     * @param DateTime|null $created
     */
    public function setCreated(?DateTime $created): void
    {
        $this->created = $created ?? new DateTime();
    }

    /**
     * @return DateTime|null
     */
    public function getUpdated(): ?DateTime
    {
        return $this->updated ?? new DateTime();
    }

    /**
     * @param DateTime|null $dateEdit
     */
    public function setUpdated(?DateTime $dateEdit): void
    {
        $this->updated = $dateEdit ?? new DateTime();
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function setUpdatedToCurrent(): void
    {
        $this->updated = new DateTime();
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedToCurrent(): void
    {
        $this->created = new DateTime();
    }
}
