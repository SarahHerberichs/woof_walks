<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\OpenApi\Model;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Entité Walk qui hérite de Ad
 */
#[ORM\Entity]
#[ApiResource(
    normalizationContext: ['groups' => ['walk:read']],
    denormalizationContext: ['groups' => ['walk:write']],
    operations: [
        new Get(),
        new GetCollection(),
        // new Post(
        //     inputFormats: ['json' => ['application/ld+json']], 
        //     outputFormats: ['jsonld' => ['application/ld+json']],
        //     openapi: new Model\Operation(
        //         requestBody: new Model\RequestBody(
        //             content: new \ArrayObject([
        //                 'application/ld+json' => [
        //                     'schema' => [
        //                         'type' => 'object',
        //                         'properties' => [
        //                             'title' => ['type' => 'string'],
        //                             'description' => ['type' => 'string'],
        //                             'date' => ['type' => 'string', 'format' => 'date'],
        //                             'time' => ['type' => 'string', 'format' => 'time'],
        //                             'max_participants' => ['type' => 'integer'],
        //                             'photo' => [
        //                                 'type' => 'string',
        //                                 'format' => 'uri',
        //                             ]
        //                         ]
        //                     ]
        //                 ]
        //             ])
        //         )
        //     )
        // )
    ]
)]
class Walk extends Ad
{
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['walk:read', 'walk:write'])]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    #[Groups(['walk:read', 'walk:write'])]
    private ?\DateTimeInterface $time = null;

    #[ORM\Column(type: 'integer')]
    #[Groups(['walk:read', 'walk:write'])]
    private ?int $max_participants = null;

    public function __construct()
    {
        parent::__construct();  // Appelle le constructeur parent pour initialiser createdAt et updatedAt

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
}
