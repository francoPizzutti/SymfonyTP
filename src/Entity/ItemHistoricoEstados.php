<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ItemHistoricoEstadosRepository")
 */
class ItemHistoricoEstados
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $Fecha_Desde;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $Fecha_Hasta;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Observacion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EstadoTicket")
     */
    private $Estado_Ticket;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $User;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ticket", inversedBy="HistorialEstado")
     */
    private $ticket;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\GrupoResolucion")
     */
    private $Grupo_De_Resolucion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ItemHistoricoClasificacion")
     */
    private $ItemClasificacion;



    public function getId(): ?int
    {
        return $this->id;
    }



    public function getFechaDesde(): ?\DateTimeInterface
    {
        return $this->Fecha_Desde;
    }
    public function getFechaDesdeString(): ?string
    {
        return $this->Fecha_Desde->format('Y-m-d');
    }
    public function getHoraDesdeString(): ?string
    {
        return $this->Fecha_Desde->format('H:i:s');
    }

    public function setFechaDesde(?\DateTimeInterface $Fecha_Desde): self
    {
        $this->Fecha_Desde = $Fecha_Desde;

        return $this;
    }

    public function getFechaHasta(): ?\DateTimeInterface
    {
        return $this->Fecha_Hasta;
    }

    public function setFechaHasta(?\DateTimeInterface $Fecha_Hasta): self
    {
        $this->Fecha_Hasta = $Fecha_Hasta;

        return $this;
    }


    public function getObservacion(): ?string
    {
        return $this->Observacion;
    }

    public function setObservacion(?string $Observacion): self
    {
        $this->Observacion = $Observacion;

        return $this;
    }

    public function getEstadoTicket(): ?EstadoTicket
    {
        return $this->Estado_Ticket;
    }

    public function setEstadoTicket(?EstadoTicket $estadoTicket): self
    {
        $this->Estado_Ticket = $estadoTicket;

        return $this;
    }


    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }


    public function __construct()
    {
        $this->Fecha_Desde=new DateTime();

    }
    public function cerrar(){
        $this->Fecha_Hasta=new DateTime();
    }

    public function getTicket(): ?Ticket
    {
        return $this->ticket;
    }

    public function setTicket(?Ticket $ticket): self
    {
        $this->ticket = $ticket;

        return $this;
    }

    public function getGrupoResolucion(): ?GrupoResolucion
    {
        return $this->Grupo_De_Resolucion;
    }

    public function setGrupoResolucion(?GrupoResolucion $Grupo_De_Resolucion): self
    {
        $this->Grupo_De_Resolucion = $Grupo_De_Resolucion;

        return $this;
    }

    public function getItemClasificacion(): ?ItemHistoricoClasificacion
    {
        return $this->ItemClasificacion;
    }

    public function setItemClasificacion(?ItemHistoricoClasificacion $ItemClasificacion): self
    {
        $this->ItemClasificacion = $ItemClasificacion;

        return $this;
    }
}
