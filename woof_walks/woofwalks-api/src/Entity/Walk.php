<?php

// //Entité héritière de Ad
// namespace App\Entity;

// use Doctrine\ORM\Mapping as ORM;
// use ApiPlatform\Metadata\ApiResource;
// use ApiPlatform\Metadata\Post;
// use ApiPlatform\Metadata\Get;
// use ApiPlatform\Metadata\GetCollection;
// use Doctrine\DBAL\Types\Types;
// use Symfony\Component\Serializer\Annotation\Groups;


// #[ORM\Entity]
// #[ApiResource(
//     normalizationContext: ['groups' => ['walk:read']],
//     denormalizationContext: ['groups' => ['walk:write']],
//     operations: [
//         new Get(),
//         new GetCollection(),
//     ]
// )]
// class Walk extends Ad
// {
//     #[ORM\Column(type: Types::DATE_MUTABLE)]
//     #[Groups(['walk:read', 'walk:write'])]
//     private ?\DateTimeInterface $date = null;

//     #[ORM\Column(type: Types::TIME_MUTABLE)]
//     #[Groups(['walk:read', 'walk:write'])]
//     private ?\DateTimeInterface $time = null;

//     #[ORM\Column(type: 'integer')]
//     #[Groups(['walk:read', 'walk:write'])]
//     private ?int $max_participants = null;

//     public function __construct()
//     {
//         parent::__construct(); 

//     }

//     public function getDate(): ?\DateTimeInterface
//     {
//         return $this->date;
//     }

//     public function setDate(\DateTimeInterface $date): self
//     {
//         $this->date = $date;
//         return $this;
//     }

//     public function getTime(): ?\DateTimeInterface
//     {
//         return $this->time;
//     }

//     public function setTime(\DateTimeInterface $time): self
//     {
//         $this->time = $time;
//         return $this;
//     }

//     public function getMaxParticipants(): ?int
//     {
//         return $this->max_participants;
//     }

//     public function setMaxParticipants(int $max_participants): self
//     {
//         $this->max_participants = $max_participants;
//         return $this;
//     }
// }



// <?php  

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;

#[ORM\Entity]
#[ApiResource(
    normalizationContext: ['groups' => ['walk:read', 'ad:read']],
    denormalizationContext: ['groups' => ['walk:write']],
    operations: [
        new Get(),
        new GetCollection(),
        new Post() 
    ]
)]
class Walk
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\OneToOne(targetEntity: Ad::class,cascade: ["persist"])]
    #[ORM\JoinColumn(name: 'ad_id', referencedColumnName: 'id', nullable: false)]
    #[Groups(['walk:read', 'walk:write', 'ad:read'])]
    private Ad $ad;

    #[ORM\Column(type: 'date')]
    #[Groups(['walk:read', 'walk:write'])]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: 'time')]
    #[Groups(['walk:read', 'walk:write'])]
    private ?\DateTimeInterface $time = null;

    #[ORM\Column(type: 'integer')]
    #[Groups(['walk:read', 'walk:write'])]
    private ?int $max_participants = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'participatedWalks')]
    #[Groups(['walk:read', 'walk:write'])]
    private $participants;

    #[ORM\OneToOne(mappedBy: 'walk', cascade: ['persist', 'remove'])]
    private ?Chat $chat = null;

    
    // Constructor: Tu peux initialiser des valeurs si nécessaire
    public function __construct()
    {
        $this->participants = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAd(): Ad
    {
        return $this->ad;
    }

    public function setAd(Ad $ad): self
    {
        $this->ad = $ad;
        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;
        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;
        return $this;
    }

    public function getMaxParticipants(): ?int
    {
        return $this->max_participants;
    }

    public function setMaxParticipants(int $max_participants): self
    {
        $this->max_participants = $max_participants;
        return $this;
    }

    public function getParticipants(): \Doctrine\Common\Collections\Collection
    {
        return $this->participants;
    }

    public function addParticipant(User $user): self
    {
        if (!$this->participants->contains($user)) {
            $this->participants[] = $user;
        }
        return $this;
    }

    public function removeParticipant(User $user): self
    {
        $this->participants->removeElement($user);
        return $this;
    }



    public function getChat(): ?Chat
    {
        return $this->chat;
    }

    public function setChat(Chat $chat): self
    {
        // Assure la relation bidirectionnelle
        if ($chat->getWalk() !== $this) {
            $chat->setWalk($this);
        }

        $this->chat = $chat;

        return $this;
    }


}
