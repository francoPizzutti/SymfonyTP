<?php

namespace App\Controller;

use App\Entity\ClasificacionTicket;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Service\error;
use App\Service\requestflash;
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

    /* FUNCIONES PARA EL REGISTRO DE TICKET */

    public function RegistrarTicket(error $error, requestflash $requestflash){
        if ($this->getUser()!= null && $this->getUser()->getNivel()==0) {
            $titulo = 'Registrar Nuevo Ticket';
            $load = '';
            $fecha = date("Y-m-d");
            $hora = date("h:i:s");
            $requestflash->set(12312);

            $repository = $this->getDoctrine()->getRepository(ClasificacionTicket::class);
            $clasificacionesDTO = $repository->findAll();

            return $this->render('MesaDeAyuda/CU01registrarticket.html.twig', [
                'titulo' => $titulo,
                'load' => $load,
                'error' =>$error,
                'fecha' => $fecha,
                'hora' => $hora,
                'requestflash' => $requestflash,
                'clasificaciones' => $clasificacionesDTO
            ]);

        }
        else return $this->redirectToRoute('index');

    }

public function ProcesarRegistrarTicket(Request $request, error $error, requestflash $requestflash){
    $load = '';

    if ($this->getUser()!= null && $this->getUser()->getNivel()==0) {
        /* recuperamos los datos enviados en el formulario*/
        $fecha = date("Y-m-d");
        $hora = date("h:i:s");
        $NTicket = $request->request->get('idTicket');
        $Nlegajo = $request->request->get('legajo');
        $Nclasificacion = $request->request->get('clasificacion');
        $Ndescripcion = $request->request->get('descripcion');
        /* #END# datos del formulario */


        //supongamos que falla el registro
       if(true){


           /* Inicializamos el requestFlash para mapear los datos del request en la plantilla */
           $requestflash->set($NTicket);
           $requestflash->set($Nlegajo);
           $requestflash->set($Ndescripcion);
           /* #END# requestFlash */

           /* Cargamos los mensajes de error para flashear en la plantilla*/
           $error->set('legajo', 'fallo en el legajo');
           $error ->set('descripcion', 'la ha pifiado chamigo con la descripcion del problema');
           /* #END# errorSet */


           $repository = $this->getDoctrine()->getRepository(ClasificacionTicket::class);
           $clasificacionesDTO = $repository->findAll();



           return $this->render('MesaDeAyuda/CU01registrarticket.html.twig', [
               'titulo' => 'flassheando mensaje',
               'load' => $load,
               'error'=> $error,
               'fecha' => $fecha,
               'hora' => $hora,
               'requestflash' => $requestflash,
               'clasificaciones' => $clasificacionesDTO
           ]);
       }
       else{
           return $this->redirectToRoute('CU01registrarTicket2');
       }


    }
    else return $this->redirectToRoute('index');
}
/* END REGISTRO DE TICKET*/


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
            $btnC="";
            $btnD="";
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
