<?php

namespace App\Entity;

use App\Entity\Traits\TimestampableTrait;
use App\Repository\InvoiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InvoiceRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Invoice
{
    use TimestampableTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $number;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=InvoiceAttachment::class, mappedBy="invoice", orphanRemoval=true, cascade={"persist", "remove"})
     */
    private $attachments;

    public function __construct()
    {
        $this->attachments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|InvoiceAttachment[]
     */
    public function getAttachments(): Collection
    {
        return $this->attachments;
    }

    public function addAttachment(InvoiceAttachment $invoiceAttachment): self
    {
        if (!$this->attachments->contains($invoiceAttachment)) {
            $this->attachments[] = $invoiceAttachment;
            $invoiceAttachment->setInvoice($this);
        }

        return $this;
    }

    public function removeAttachment(InvoiceAttachment $invoiceAttachment): self
    {
        if ($this->attachments->removeElement($invoiceAttachment)) {
            // set the owning side to null (unless already changed)
            if ($invoiceAttachment->getInvoice() === $this) {
                $invoiceAttachment->setInvoice(null);
            }
        }

        return $this;
    }
}
