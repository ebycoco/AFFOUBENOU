<?php

namespace App\Entity;

use App\Repository\CommandeLogoPersonaliseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeLogoPersonaliseRepository::class)
 */
class CommandeLogoPersonalise
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
