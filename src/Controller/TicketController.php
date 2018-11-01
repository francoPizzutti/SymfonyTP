<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class TicketController extends AbstractController
{
    /**
     * @Route("/ticket", name="ticket")
     */
    public function f(){
        if ($this->getUser()!= null) {
            $titulo = 'Registrar Nuevo Ticket';
            $load = '';
            return $this->render('MesaDeAyuda/CU01registrarticket.html.twig', [
                'titulo' => $titulo,
                'load' => $load,
            ]);

        }
        else return $this->redirectToRoute('index');

    }

    public function RegistrarTicket(){
        if ($this->getUser()!= null) {
            $titulo = 'Registrar Nuevo Ticket';
            $load = '';
            return $this->render('MesaDeAyuda/CU01registrarticket.html.twig', [
                'titulo' => $titulo,
                'load' => $load,
            ]);

        }
        else return $this->redirectToRoute('index');

    }
    public function AccionesRqueridas(){
        if ($this->getUser()!= null) {
            $titulo = 'Acciones Rqueridas';
            $load = '';
            return $this->render('MesaDeAyuda/CU01registrarticket2.html.twig', [
                'titulo' => $titulo,
                'load' => $load,
            ]);

        }
        else return $this->redirectToRoute('index');

    }

    public function ConsultarTicket(){
        if ($this->getUser()!= null) {
            $titulo = 'Consultar Ticket';
            $load = '';
            return $this->render('MesaDeAyuda/CU02ConsultarTicket.html.twig', [
                'titulo' => $titulo,
                'load' => $load,
            ]);

        }
        else return $this->redirectToRoute('index');

    }

    public function VerListaTicket(){
        if ($this->getUser()!= null) {
            $titulo = 'Listado de Tickets consultados';
            $load = 'onload=sacar()';
            return $this->render('MesaDeAyuda/CU02ConsultarTicket2.html.twig', [
                'titulo' => $titulo,
                'load' => $load,
            ]);

        }
        else return $this->redirectToRoute('index');

    }


    public function VerDetalleTicket($id){
        if ($this->getUser()!= null) {
            $titulo = 'Detalle de Ticket';
            $btnD="";
            $btnC="";
            $load = 'onload=sacar()';
            return $this->render('MesaDeAyuda/CU02ConsultarTicket3.html.twig', [
                'titulo' => $titulo,
                'load' => $load,
                'idTicket'=>$id,
                'btnDerivar' => $btnD,
                'btnCerrar' => $btnC
            ]);

        }
        else return $this->redirectToRoute('index');

    }

    public function DerivarTicket($id){
        if ($this->getUser()!= null) {
            $titulo = 'Derivar Ticket';
            $load = 'onload=sacar()';
            return $this->render('MesaDeAyuda/CU04DerivarTicket.html.twig', [
                'titulo' => $titulo,
                'load' => $load,
                'idTicket'=>$id
            ]);

        }
        else return $this->redirectToRoute('index');

    }

    public function CerrarTicket($id){
        if ($this->getUser()!= null) {
            $titulo = 'Cerrar Ticket';
            $load = 'onload=sacar()';
            return $this->render('MesaDeAyuda/CU03CerrarTicket.html.twig', [
                'titulo' => $titulo,
                'load' => $load,
                'idTicket'=>$id,
                'btnDerivar' => $btnD,
                'btnCerrar' => $btnC
            ]);

        }
        else return $this->redirectToRoute('index');

    }

}
