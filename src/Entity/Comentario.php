<?php

namespace App\Entity;

use App\Repository\ComentarioRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ComentarioRepository::class)
 */
class Comentario
{
    const COMENTARIO_AGREGADO_EXITOSAMENTE = '¡Comentario Agregado exitosamente!';
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $comentario;



    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="comentario")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Posts", inversedBy="comentario")
     */
    private $posts;




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComentario(): ?string
    {
        return $this->comentario;
    }

    public function setComentario(string $comentario): self
    {
        $this->comentario = $comentario;

        return $this;
    }




    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @param mixed $posts
     */
    public function setPosts($posts): void
    {
        $this->posts = $posts;
    }

}
