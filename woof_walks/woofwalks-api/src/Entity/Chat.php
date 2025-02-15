<?php

namespace App\Entity;

use App\Repository\ChatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChatRepository::class)]
class Chat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'chat', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Walk $walk = null;

    #[ORM\OneToMany(mappedBy: 'chat', targetEntity: ChatMessage::class, cascade: ['persist', 'remove'])]
    private Collection $messages;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWalk(): ?Walk
    {
        return $this->walk;
    }

    public function setWalk(Walk $walk): self
    {
        $this->walk = $walk;

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(ChatMessage $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setChat($this);
        }

        return $this;
    }

    public function removeMessage(ChatMessage $message): self
    {
        if ($this->messages->removeElement($message)) {
            // Détacher la relation
            if ($message->getChat() === $this) {
                $message->setChat(null);
            }
        }

        return $this;
    }
}
