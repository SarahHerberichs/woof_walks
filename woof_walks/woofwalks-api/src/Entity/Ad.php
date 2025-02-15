<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Entity\Photo;


#[ORM\Entity]
#[ORM\Table(name: 'ad')]
class Ad
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[Groups(['ad:read', 'ad:write'])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string $title;

    #[Groups(['ad:read', 'ad:write'])]
    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[Groups(['ad:read', 'ad:write'])]
    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $createdAt;

    #[Groups(['ad:read', 'ad:write'])]
    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $updatedAt;

    #[Groups(['ad:read', 'ad:write', 'photo:read'])]
    #[ORM\ManyToOne(targetEntity: Photo::class)]
    #[ORM\JoinColumn(nullable: false)] // Empêche qu'une annonce soit créée sans photo
    private Photo $photo;


    #[Groups(['ad:read', 'ad:write'])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $type = null; 
    #[Groups(['ad:read', 'ad:write'])]

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'createdAds')]
    #[ORM\JoinColumn(nullable: false)]
    private User $creator;
    

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
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

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getPhoto(): Photo
    {
        return $this->photo;
    }

    public function setPhoto(Photo $photo): self
    {
        $this->photo = $photo;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;
        return $this;
    }

      public function getCreator(): User
    {
        return $this->creator;
    }

    public function setCreator(User $creator): self
    {
        $this->creator = $creator;
        return $this;
    }
}

// //Entité mère de Walks, Hike et Parcs

// namespace App\Entity;
// use App\Entity\Photo;
// use Doctrine\ORM\Mapping as ORM;
// use Symfony\Component\Serializer\Annotation\Groups;


// #[ORM\Entity]
// #[ORM\Table(name: 'ad')]
// #[ORM\InheritanceType('JOINED')]
// #[ORM\DiscriminatorColumn(name: 'type', type: 'string')]
// #[ORM\DiscriminatorMap(['walk' => Walk::class])]



// class Ad
// {
//     #[ORM\Id]
//     #[ORM\GeneratedValue]
//     #[ORM\Column(type: 'integer')]
//     private int $id;

//     #[Groups(['ad:read', 'walk:read'])]
//     #[ORM\Column(type: 'string', length: 255,  nullable: true)]
//     private string $title;

//     #[Groups(['ad:read', 'walk:read'])]
//     #[ORM\Column(type: 'text', nullable: true)]
//     private ?string $description = null;

//     #[Groups(['ad:read', 'walk:read'])]
//     #[ORM\Column(type: 'datetime')]
//     private \DateTimeInterface $createdAt;

//     #[Groups(['ad:read', 'walk:read'])]
//     #[ORM\Column(type: 'datetime')]
//     private \DateTimeInterface $updatedAt;

//     #[Groups(['ad:read', 'walk:read','photo:read'])]
//     #[ORM\ManyToOne(targetEntity: Photo::class)]
//     #[ORM\JoinColumn(nullable: false)] // Empêche qu'une annonce soit créée sans photo

//     private Photo $photo;

//     public function __construct()
//     {
//         $this->createdAt = new \DateTime(); 
//         $this->updatedAt = new \DateTime();
//     }


//     public function getId(): int
//     {
//         return $this->id;
//     }

//     public function getTitle(): string
//     {
//         return $this->title;
//     }

//     public function setTitle(string $title): self
//     {
//         $this->title = $title;
//         return $this;
//     }

//     public function getDescription(): ?string
//     {
//         return $this->description;
//     }

//     public function setDescription(?string $description): self
//     {
//         $this->description = $description;
//         return $this;
//     }

//     public function getCreatedAt(): \DateTimeInterface
//     {
//         return $this->createdAt;
//     }

//     public function setCreatedAt(\DateTimeInterface $createdAt): self
//     {
//         $this->createdAt = $createdAt;
//         return $this;
//     }

//     public function getUpdatedAt(): \DateTimeInterface
//     {
//         return $this->updatedAt;
//     }

//     public function setUpdatedAt(\DateTimeInterface $updatedAt): self
//     {
//         $this->updatedAt = $updatedAt;
//         return $this;
//     }

//     public function getPhoto(): Photo
//     {
//         return $this->photo;
//     }

//     public function setPhoto(Photo $photo): self
//     {
//         $this->photo = $photo;
//         return $this;
//     }
// }
