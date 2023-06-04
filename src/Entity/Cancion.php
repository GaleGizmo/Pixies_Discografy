<?php

namespace App\Entity;

use App\Repository\CancionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CancionRepository::class)]
class Cancion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['album'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['album'])]
    private ?string $titulo = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['album'])]
    private ?int $duracion = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['album'])]
    private ?string $letra = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fecha_lanzamiento = null;

    #[ORM\ManyToOne(inversedBy: 'canciones'), ORM\JoinColumn(nullable: true)]
    private ?Album $album = null;

    

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getDuracion(): ?int
    {
        return $this->duracion;
    }

    public function setDuracion(?int $duracion): self
    {
        $this->duracion = $duracion;

        return $this;
    }

    public function getLetra(): ?string
    {
        return $this->letra;
    }

    public function setLetra(?string $letra): self
    {
        $this->letra = $letra;

        return $this;
    }

    public function getFechaLanzamiento(): ?\DateTimeInterface
    {
        return $this->fecha_lanzamiento;
    }

    public function setFechaLanzamiento(?\DateTimeInterface $fecha_lanzamiento): self
    {
        $this->fecha_lanzamiento = $fecha_lanzamiento;

        return $this;
    }

    public function getAlbum(): ?Album
    {
        return $this->album;
    }

    public function setAlbum(?Album $album): self
    {
        $this->album = $album;

        return $this;
    }
}
