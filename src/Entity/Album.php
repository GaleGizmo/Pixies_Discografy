<?php

namespace App\Entity;

use App\Repository\AlbumRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Intervention\Image\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AlbumRepository::class)]
class Album
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('album')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups('album')]
    private ?string $titulo = null;

   
    #[ORM\Column]
    #[Groups('album')]
    public ?int $fecha_publicacion = null;

    #[ORM\Column(nullable: true)]
    #[Groups('album')]
    private ?int $duracion = null;


    #[ORM\Column(length: 255, nullable: true)]
    #[Groups('album')]
    private ?string $sello = null;

    #[ORM\Column( length: 255,nullable: true)]
    #[Groups('album')]
    private ?string $productor = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups('album')]
    private ?string $imagen = null;

    // #[Groups('album')]
    // #[ORM\OneToMany(mappedBy: 'album', targetEntity: Cancion::class, orphanRemoval: true)]
    // private Collection $canciones;

   
    // public function __construct()
    // {
    //     $this->canciones = new ArrayCollection();
    // }

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

   

    public function getFechaPublicacion(): ?int
    {
        return $this->fecha_publicacion;
    }

    public function setFechaPublicacion(int $fecha_publicacion): self
    {
        $this->fecha_publicacion = $fecha_publicacion;

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


    public function getSello(): ?string
    {
        return $this->sello;
    }

    public function setSello(?string $sello): self
    {
        $this->sello = $sello;

        return $this;
    }

    public function getProductor(): string
    {
        return $this->productor;
    }

    public function setProductor(?string $productor): self
    {
        $this->productor = $productor;

        return $this;
    }
    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(?string $imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }

    // /**
    // * @return Collection<int, Cancion>
    // */
    // public function getCanciones(): Collection
    // {
    //     return $this->canciones;
    // }

    // public function addCancion(Cancion $cancion): self
    // {
    //     if (!$this->canciones->contains($cancion)) {
    //         $this->canciones->add($cancion);
    //         $cancion->setAlbum($this);
    //     }

    //     return $this;
    // }

    // public function removeCancion(Cancion $cancion): self
    // {
    //     if ($this->canciones->removeElement($cancion)) {
            
    //         if ($cancion->getAlbum() === $this) {
    //             $cancion->setAlbum(null);
    //         }
    //     }

    //     return $this;
    // }

   

}


