<?php

// src/Entity/PhotoEntity.php

namespace App\Entity;

use App\Entity\Walk;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiProperty;

#[ORM\Entity]
#[ORM\Table(name: "photo_entity")]
class PhotoEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: "App\Entity\Photo")]
    #[ORM\JoinColumn(name: "photo_id", referencedColumnName: "id", nullable: false)]
    private ?Photo $photo = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $entityClass = null;

    #[ORM\ManyToOne(targetEntity: "App\Entity\Walk")]
    #[ORM\JoinColumn(name: "entity_id", referencedColumnName: "id", nullable: false)]
    private ?Walk $entity = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhoto(): ?Photo
    {
        return $this->photo;
    }

    public function setPhoto(?Photo $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEntityClass(): ?string
    {
        return $this->entityClass;
    }

    public function setEntityClass(string $entityClass): self
    {
        $this->entityClass = $entityClass;

        return $this;
    }

    public function getEntity(): ?Walk
    {
        return $this->entity;
    }

    public function setEntity(?Walk $entity): self
    {
        $this->entity = $entity;

        return $this;
    }
}
