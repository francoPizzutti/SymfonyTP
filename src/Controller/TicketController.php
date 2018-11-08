<?php

namespace App\Controller;

use App\Entity\ClasificacionTicket;
use App\Entity\Empleado;
use App\Entity\EstadoIntervencion;
use App\Entity\EstadoTicket;
use App\Entity\GrupoResolucion;
use App\Entity\Intervencion;
use App\Entity\ItemHistoricoClasificacion;
use App\Entity\ItemHistoricoEstados;
use App\Entity\ItemHistoricoIntervencion;
use App\Entity\Ticket;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Service\error;
use App\Service\requestflash;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

/* Componentes de validacion*/
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
/* #END# componentes de validacion*/


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
            $last = $this->getDoctrine()
                ->getRepository(Ticket::class)
                ->lastT();

            if($last != null) {

                $requestflash->set($last[0]->getNroTicket() + 1);
            }
            else  $requestflash->set(1);

            $repository = $this->getDoctrine()->getRepository(ClasificacionTicket::class);
            $clasificacionesDTO = $repository->findBy(
                [],
                ['Nombre' => 'ASC']
            );


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


    if ($this->getUser()!= null && $this->getUser()->getNivel()==0) {
        /* recuperamos los datos enviados en el formulario*/
        $fecha = date("Y-m-d");
        $hora = date("h:i:s");
        $NTicket = $request->request->get('idTicket');
        $Nlegajo = $request->request->get('legajo');
        $Nclasificacion = $request->request->get('clasificacion');
        $Ndescripcion = $request->request->get('descripcion');
        /* #END# datos del formulario */


        /* Validamos los parametros obtenidos*/


        /* #END# VALIDACION*/


        //supongamos que falla el registro
       if(!$this->ValidaDescripcion($Ndescripcion) || !$this->ValidaLegajo($Nlegajo) || !$this->ValidaClasificacion($Nclasificacion)){

           /*SETEAMOS LOS ERRORES*/
           if($this->ValidaDescripcion($Ndescripcion)==false){
               $error ->set('descripcion', 'La descripción del problema debe contener min 3 caracteres y max 255');
           }
           if($this->ValidaLegajo($Nlegajo)==false){
               $error->set('legajo', 'El legajo contiene un formato incorrecto o no pertenece a un empleado');
           }
           if($this->ValidaClasificacion($Nclasificacion)==false){
               $error->set('clasificacion', 'La clasificacion es incorrecta');
           }
           /* #END# SET ERRORES*/


           /* Inicializamos el requestFlash para mapear los datos del request en la plantilla */
           $requestflash->set($NTicket);
           $requestflash->set($Nlegajo);
           $requestflash->set($Ndescripcion);
           /* #END# requestFlash */

           $repository = $this->getDoctrine()->getRepository(ClasificacionTicket::class);
           $clasificacionesDTO = $repository->findAll();
           $load="";



           return $this->render('MesaDeAyuda/CU01registrarticket.html.twig', [
               'titulo' => 'Error en el registro',
               'load' => $load,
               'error'=> $error,
               'fecha' => $fecha,
               'hora' => $hora,
               'requestflash' => $requestflash,
               'clasificaciones' => $clasificacionesDTO
           ]);
       }
       else{
           $entityManager = $this->getDoctrine()->getManager();
           /* PEDIMOS EL USUARIO A LA SESSION */
           $usuario = $this->getUser();
           /* #END# USUARIO*/

           /*BUSCAMOS EL EMPLEADO*/
           $repository = $this->getDoctrine()->getRepository(Empleado::class);
           $empleado = $repository->findBy(['Legajo' => $Nlegajo]);
           /* #END# EMPLEADO*/

           /*BUSCAMOS LA CLASIFICACION*/
           $repository = $this->getDoctrine()->getRepository(ClasificacionTicket::class);
           $clasificacion = $repository->find($Nclasificacion);
           /* #END# CLASIFICACION*/


           /* BUSCAMOS EL ESTADO ABIERTO SIN DERIVAR */
           $repository = $this->getDoctrine()->getRepository(EstadoTicket::class);
           $estado = $repository->find(1);
           /* #END# ESTADO*/

           /*CREAMOS EL TICKET E INICIALIZAMOS*/
           $ticket = new Ticket();
           $ticket->inicializar($Ndescripcion, $NTicket, $empleado[0], $usuario);
           /* #END# TICKET*/

           /*CREAMOS Y SETEAMOS EL ITEM HISTORICO DE ESTADOS*/
           $he = new ItemHistoricoEstados();
           $he->setUser($usuario);
           $he->setEstadoTicket($estado);
           /* #END# ITEM HISTORICO DE ESTADOS*/

           /*CREAMOS Y SETEAMOS EL ITEM HISTORICO DE RECLASIFICACION*/
           $hr = new ItemHistoricoClasificacion();
           $hr->setUser($usuario);
           $hr->setClasificacion($clasificacion);
           /* #END# ITEM HISTORICO DE RECLASIFICACION*/

           /*AGREGAMOS LOS HISTORIALES AL TICKET*/
           $ticket->addHistorialEstado($he);
           $ticket->addHistorialClasificacione($hr);
           /* #END# ADD HISTORIALES*/

           /* CREAMOS LA INTERVENCION PARA LA MESA DE AYUDA*/
           $repository = $this->getDoctrine()->getRepository(EstadoIntervencion::class);
           $estadoInt = $repository->find(4);

           $repository = $this->getDoctrine()->getRepository(GrupoResolucion::class);
           $mesaAyuda = $repository->find(1);

           $intervencion = new Intervencion();
           $mesaAyuda->addIntervencione($intervencion);

           $hi = new ItemHistoricoIntervencion();
           $hi->setUser($usuario);
           $hi->setEstadoIntervencion($estadoInt);
           $intervencion->addHistorialIntervencion($hi);
           $ticket->addIntervencione($intervencion);

           $entityManager->persist($ticket);


           $entityManager->flush();




           /* #END# INTERVENCION*/

           $load = 'successNotify("El Ticket fue creado con éxito  con el Nro: '.$NTicket.', Nro de Legajo: '.$Nlegajo.'")';
           $requestflash->set($NTicket);


           return $this->render('MesaDeAyuda/CU01registrarticket2.html.twig', ['load' => $load,
               'titulo' => 'Acciones Requeridas',
               'error' =>$error,
               'requestflash' => $requestflash]);
       }


    }
    else return $this->redirectToRoute('index');
}
/* END REGISTRO DE TICKET*/


    public function CU01CerrarMesa(Request $request, requestflash $requestflash, error $error){

        if ($this->getUser()!= null && $this->getUser()->getNivel()==0) {
            /* recuperamos los datos enviados en el formulario*/
            $NTicket = $request->request->get('idTicket');
            $Nobservacion = $request->request->get('observacion');

            /* #END# datos del formulario */
            if (!$this->ValidaDescripcion($Nobservacion) || !$this->ValidaTicket($NTicket)) {
                if($this->ValidaDescripcion($Nobservacion)==false){
                    $error->set('observacion', 'Las observaciones no cumplen con los requerimientos min 3 caracteres, max 255');
                    $requestflash->set($Nobservacion);
                }
                if($this->ValidaTicket($NTicket)==false){
                    $error->set('ticket', 'El ticket es inexistente');
                    $requestflash->set($NTicket);
                }

            }
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

    public function ValidaDescripcion($dec){
        $validator = Validation::createValidator();
        $violations = $validator->validate($dec, array(
            new Length(array('min' => 3, 'max' =>255)),
            new NotBlank(),
        ));

        if (0 !== count($violations)) {
            return false;
            }
           else return true;
        }

    public function ValidaLegajo($leg)
    {
        if(is_numeric($leg)){
            $repository = $this->getDoctrine()->getRepository(Empleado::class);
            $emp = $repository->findOneBy(['Legajo'=> $leg]);
            if($emp!=null){
                return true;
            }
            else return false;

        }
        else{
            return false;
        }
    }

    public function ValidaClasificacion($cla)
    {
        if(is_numeric($cla)){
            $repository = $this->getDoctrine()->getRepository(ClasificacionTicket::class);
            $class = $repository->findOneBy(['id'=> $cla]);
            if($class!=null){
                return true;
            }
            else return false;

        }
        else{
            return false;
        }
    }

        public function ValidaTicket($nro)
        {
            if(is_numeric($nro)){
                $repository = $this->getDoctrine()->getRepository(Ticket::class);
                $ticket = $repository->findOneBy(['Nro_Ticket'=> $nro]);
                if($ticket!=null){
                    return true;
                }
                else return false;

            }
            else{
                return false;
            }
        }


}
