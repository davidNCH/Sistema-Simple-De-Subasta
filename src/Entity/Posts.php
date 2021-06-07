<?php

namespace App\Entity;

use App\Repository\PostsRepository;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=PostsRepository::class)
 */
class Posts
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $titulo;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $likes;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $foto;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha_publicacion;

    /**
     * @ORM\Column(type="string", length=80000)
     */
    private $contenido;

    /**
     *@var integer
     * @ORM\Column(name="precioinicial",type="integer", nullable=false)
     *
     */
    private $precioinicial;

    /**
     *@var integer
     * @ORM\Column(name="preciofinal",type="integer", nullable=false)
     *
     */
    private $preciofinal;




    /**
     * @ORM\OneToMany (targetEntity="App\Entity\Comentario", mappedBy="posts")
     */
    private $comentario;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="posts")
     */
    private $user;

    /**
     * Posts constructor.
     */
    public function __construct()
    {
        $this->likes='';
        $this->fecha_publicacion =new \DateTime();
    }


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

    public function getLikes(): ?string
    {
        return $this->likes;
    }

    public function setLikes(?string $likes): self
    {
        $this->likes = $likes;

        return $this;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(string $foto): self
    {
        $this->foto = $foto;

        return $this;
    }

    public function getFechaPublicacion(): ?\DateTimeInterface
    {
        return $this->fecha_publicacion;
    }

    public function setFechaPublicacion(\DateTimeInterface $fecha_publicacion): self
    {
        $this->fecha_publicacion = $fecha_publicacion;

        return $this;
    }

    public function getContenido(): ?string
    {
        return $this->contenido;
    }

    public function setContenido(string $contenido): self
    {
        $this->contenido = $contenido;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * @param mixed $comentario
     */
    public function setComentario($comentario): void
    {
        $this->comentario = $comentario;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return int
     */
    public function getPrecioinicial(): int
    {
        return $this->precioinicial;
    }

    /**
     * @param int $precioinicial
     */
    public function setPrecioinicial(int $precioinicial): void
    {
        $this->precioinicial = $precioinicial;
    }

    /**
     * @return int
     */
    public function getPreciofinal(): int
    {
        return $this->preciofinal;
    }

    /**
     * @param int $preciofinal
     */
    public function setPreciofinal(int $preciofinal): void
    {
        $this->preciofinal = $preciofinal;
    }


}
