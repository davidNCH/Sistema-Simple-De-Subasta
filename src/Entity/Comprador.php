<?php

namespace App\Entity;

use App\Repository\CompradorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompradorRepository::class)
 */
class Comprador
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     *@var string
     * @ORM\Column(name="apellidos",type="string", length=50, nullable=false)
     *
     */
    private  $apellidos;

    /**
     *@var string
     * @ORM\Column(name="direccion",type="string", length=100, nullable=false)
     *
     */
    private $direccion;

    /**
     *@var string
     * @ORM\Column(name="nacionalidad",type="string", length=50, nullable=false)
     *
     */
    private $nacionalidad;



    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="comprador")
     */
    private $user;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return string
     */
    public function getApellidos(): string
    {
        return $this->apellidos;
    }

    /**
     * @param string $apellidos
     */
    public function setApellidos(string $apellidos): void
    {
        $this->apellidos = $apellidos;
    }

    /**
     * @return string
     */
    public function getDireccion(): string
    {
        return $this->direccion;
    }

    /**
     * @param string $direccion
     */
    public function setDireccion(string $direccion): void
    {
        $this->direccion = $direccion;
    }

    /**
     * @return string
     */
    public function getNacionalidad(): string
    {
        return $this->nacionalidad;
    }

    /**
     * @param string $nacionalidad
     */
    public function setNacionalidad(string $nacionalidad): void
    {
        $this->nacionalidad = $nacionalidad;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }


}
