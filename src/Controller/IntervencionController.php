<?php

namespace App\Controller;

use App\Entity\EstadoIntervencion;
use App\Entity\EstadoTicket;
use App\Entity\GrupoResolucion;
use App\Entity\Intervencion;
use App\Entity\ItemHistoricoEstados;
use App\Entity\ItemHistoricoIntervencion;
use App\Entity\Ticket;
use App\Repository\EstadoIntervencionRepository;
use App\Service\error;
use App\Service\intervencionDTO;
use App\Service\requestflash;
use App\Service\ticketIntervencionDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;

class IntervencionController extends AbstractController
{
    /**
     * @Route("/intervencion", name="intervencion")
     */


    /** ################################################################################################################## */
    /*---------------FUNCIONES PARA LA PRESENTACION DE LAS VISTAS----------------------------------------------------------*
    /** ################################################################################################################## */

    //ENVIA LA VISTA PARA CONSULTAR EL LISTADO DE INTERVENCIONES
    public function VistaConsulta()
    {
        if ($this->getUser()!= null && $this->getUser()->getGrupoResolucion()->getId()!=1) {
            $repository = $this->getDoctrine()->getRepository(EstadoIntervencion::class);
            $estadosI = $repository->findAll();
            return $this->render('GrupoDeResolucion/CU07ConsultarIntervenciones.html.twig', [
                'titulo' => 'Consultar Intervenciones',
                'load' => '',
                'estados' => $estadosI
            ]);
        }
        else return $this->redirectToRoute('home');
    }

    //PRESENTA LA VISTA PARA ACTUALIZAR UNA INTERVENCION, RECIBE COMO PARAMETRO EL ID DEL TICKET Y EL DE LA INTERVENCION
    public function VistaActualizar($id, error $error){
        if ($this->getUser()!= null && $this->getUser()->getGrupoResolucion()->getId()!=1) {
            $repository = $this->getDoctrine()->getRepository(EstadoIntervencion::class);
            $estados = $repository->findBy(
                [],
                ['Descripcion' => 'ASC']
            );
            $dto = $this->buildIntervencionDTO($id);

            return $this->render('GrupoDeResolucion/CU08ActualizarIntervencion.html.twig', [
                'load' => 'sacar()',
                'titulo' => 'Actualizar Intervención',
                'estados' => $estados,
                'dto' => $dto,
                'error' => $error
            ]);


        }else return $this->redirectToRoute('home');
    }

    /** ################################################################################################################## */
    /*---------------PROCESAMIENTO DE FORMULARIOS--------------------------------------------------------------------------*
    /** ################################################################################################################## */

    //PROCESA LA CONSULTA Y RETORNA A LA VISTA CON LOS RESULTADOS DE LA CONSULTA DE INTERVENCIONES
    public function ProcesarConsulta(Request $request){
        if ($this->getUser()!= null && $this->getUser()->getGrupoResolucion()->getId()!=1) {
            //obtenemos la lista de parametros enviados
            $Nestado = $request->request->get('estado');
            $Nticket = $request->request->get('ticket');
            $Nlegajo = $request->request->get('legajo');
            $NfechaD = $request->request->get('fechaD');
            $NfechaH = $request->request->get('fechaH');
            $Ngrupo = $this->getUser()->getGrupoResolucion()->getId();

            $repository = $this->getDoctrine()->getRepository(Ticket::class);
            $result = $repository->ConsultarIntervenciones($Ngrupo, $Nestado, $Nticket, $Nlegajo, $NfechaD, $NfechaH);

            if ($result!=null){



                $stat = $this->HeaderStat($result, 1, 4);
                $resultDTO = $this->buildTicketIntervencionDTO($result);


                return $this->render('GrupoDeResolucion/CU07ConsultarIntervenciones2.html.twig',['titulo' => 'Resultados obtenidos',
                    'load' => '',
                    'stat' => $stat,
                    'resultado' => $resultDTO,
                ]);
            }
            else{
                return $this->render('GrupoDeResolucion/CU07ConsultarIntervenciones2.html.twig',['titulo' => 'No existen resultados',
                    'load' => '',
                    'stat' => [0,0,0,0],
                    'resultado' => 'nada de nada',
                ]);
            }

        }else return $this->redirectToRoute('home');


    }

    //PROCESA UN FORMULARIO PARA ACTUALIZAR UNA INTERVENCION
    public function Actualizar(Request $request, error $error){

        if ($this->getUser()!= null && $this->getUser()->getGrupoResolucion()->getId()!=1) {
            $gr = $this->getUser()->getGrupoResolucion();
            //recuperamos los parametros enviados en el request
            $Nestado = $request->request->get('estado');
            $Nobservacion = $request->request->get('observacion');
            $Nticket =  $request->request->get('ticket');
            $Nintervencion =  $request->request->get('intervencion');


            $repository = $this->getDoctrine()->getRepository(EstadoIntervencion::class);
            $estados = $repository->findBy(
                [],
                ['Descripcion' => 'ASC']
            );

            if ($this->ValidaDescripcion($Nobservacion)){
                //Vamos a recuperar el ticket y la intervencion por separado
                $repository = $this->getDoctrine()->getRepository(Ticket::class);
                $ticket = $repository->find($Nticket);
                $intervencion = $ticket->recuperarIntervencion($this->getUser()->getGrupoResolucion());

                $intervencion->setObservaciones($Nobservacion);



                /* DENTRO DE ESTE FRAGMENTO SE PONE EN MARCHA LA MAQUINA DE ESTADOS*/

                /*Evaluamos si el estado anterior de la intervencion es asignada, si es asi
                puede ser cerrada, pausada o rechazada. En caso contrario se retorna indicando que el ticket
                esta en posesión de la mesa de ayuda*/
                $repository = $this->getDoctrine()->getRepository(EstadoIntervencion::class);
                $estadoASignada = $repository->find(1);
                if ($intervencion->getHistorialIntervencion()->last()->getEstadoIntervencion()==$estadoASignada){
                    switch ($Nestado) {
                        case 2:
                            //rechazada
                            $this->RechazarIntervencion($intervencion);
                            $observacion = "Rechazó la intervencion con el siguiente mensaje: ".$Nobservacion;
                            $this->Devolver($ticket, $observacion);
                             break;
                        case 3:
                            //pausada
                            $this->PausarIntervencion($intervencion);
                            $observacion = "Pausó la intervencion con el siguiente mensaje: ".$Nobservacion;
                            $this->Devolver($ticket, $observacion);
                              break;
                        case 4:
                           //cerrada
                            $this->CerrarIntervencion($intervencion);
                            if($this->poseeIntervencionesAbiertas($ticket)){
                                $observacion = "Cerró la intervencion con el siguiente mensaje: ".$Nobservacion;
                               $this->Devolver($ticket, $observacion);
                           }else $this->Terminar($ticket);
                            break;

                        default:
                            //Retornamos con mensaje de error
                    }

                }
                else{
                    /* como la intervencion esta en mesa de ayuda u otro grupo de resolucion retornamos con un mensaje*/

                    $dto = $this->buildIntervencionDTO($Nticket);
                    return $this->render('GrupoDeResolucion/CU08ActualizarIntervencion.html.twig', [
                        'load' => 'warning("El ticket no pertenece al grupo de resolucion")',
                        'titulo' => 'Actualizar Intervención',
                        'estados' => $estados,
                        'dto' => $dto,
                        'error' => $error
                    ]);
                }
                /* FIN MAQUINA DE ESTADOS*/



                $dto = $this->buildIntervencionDTO($Nticket);
                    return $this->render('GrupoDeResolucion/CU08ActualizarIntervencion.html.twig', [
                        'load' => 'success("El estado de la intervencion fue actualizado correctamente")',
                        'titulo' => 'Actualizar Intervención',
                        'estados' => $estados,
                        'dto' => $dto,
                        'error' => $error
                    ]);

            }
            else{
                $error->set('observacion', 'La descripcion no cumple con los requisitos');

                $dto = $this->buildIntervencionDTO($Nticket);

                return $this->render('GrupoDeResolucion/CU08ActualizarIntervencion.html.twig', [
                    'load' => 'sacar()',
                    'titulo' => 'Actualizar Intervención',
                    'estados' => $estados,
                    'dto' => $dto,
                    'error' => $error
                ]);


            }

        }else return $this->redirectToRoute('home');

    }


    /** ################################################################################################################## */
    /*---------------FUNCIONES AUXILIARES PARA EL MAQUETEADO DE LAS VISTAS-------------------------------------------------*
    /** ################################################################################################################## */

    /* ARMA EL HEADER CON TODAS LAS ESTADISTICAS DE LA BUSQUEDA*/
    public function HeaderStat($arrayResult, $idEstado, $idEstado2){
        $repository = $this->getDoctrine()->getRepository(EstadoIntervencion::class);
        $Estado1 = $repository->find($idEstado);
        $Estado2 = $repository->find($idEstado2);
        $grupo = $this->getUser()->getGrupoResolucion();
        $ct = count($arrayResult);
        $arrL = array();
        $E = 0;
        $C=0;
        foreach ($arrayResult as $a){
            array_push($arrL, $a->getEmpleado()->getLegajo());

            if($a->recuperarIntervencion($grupo)->getHistorialIntervencion()->last()->getEstadoIntervencion() == $Estado1)$E++;
            if($a->recuperarIntervencion($grupo)->getHistorialIntervencion()->last()->getEstadoIntervencion() == $Estado2)$C++;

        }
        $legajos = array_unique($arrL);
        return array(count($arrayResult), count($legajos), $E, $C);
    }

    /* CONSTRUYE EL ARRAY DE TICKETDTO PARA ENVIAR A LA VISTA*/
    public function buildTicketIntervencionDTO($result){
        $arrayDTO = array();
        foreach ($result as $ticket){
            $dto = new ticketIntervencionDTO();
            $dto->setId($ticket->getId());
            $dto->setClasificacion($ticket->getLastHistorialClasificacion()->getClasificacion()->getNombre());
            $dto->setEstado($ticket->getLastHistorialEstados()->getEstadoTicket()->getDescripcion());
            $dto->setFechaApertura($ticket->getFechaString());
            $dto->setGrupoResolucion($ticket->getLastHistorialEstados()->getGrupoResolucion()->getNombre());
            $dto->setLegajo($ticket->getEmpleado()->getLegajo());
            $grupo = $this->getUser()->getGrupoResolucion();
            $interv = $ticket->recuperarIntervencion($grupo);
            $dto->setObservacion($interv->getObservaciones());
            $dto->setFechaAsig($interv->getFechaDesdeString());
            $dto->setEstIntervencion($interv->getHistorialIntervencion()->last()->getEstadoIntervencion()->getDescripcion());
            $dto->setIntervencion($interv->getId());
            array_push($arrayDTO, $dto);
        }
        return $arrayDTO;

    }

    /* VALIDA LA DESCRIPCION DE TICKET*/
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

    /* CONSTRUYE EL DTO PARA EL ENVIO DE DATOS A LA VISTA ACTUALIZAR INTERVENCION */
    public function buildIntervencionDTO($id){
        $dto = new intervencionDTO();
        $repository = $this->getDoctrine()->getRepository(Ticket::class);
        $ticket = $repository->find($id);
        $dto->setDescripcion($ticket->getDescripcion());
        $dto->setClasificacion($ticket->getLastHistorialClasificacion()->getClasificacion()->getNombre());

        $intervencion = $ticket->recuperarIntervencion($this->getUser()->getGrupoResolucion());
        $dto->setIntervencion($intervencion->getId());
        $dto->setTicket($id);
        $dto->setEstadoActual($intervencion->getHistorialIntervencion()->last()->getEstadoIntervencion()->getDescripcion());
        $dto->setObservacion($intervencion->getObservaciones());
        return $dto;
    }

    /* RECHAZA UNA INTERVENCION*/
    public function RechazarIntervencion(Intervencion $intervencion){
        //cerramos el último item histórico de intervención
        $intervencion->getHistorialIntervencion()->last()->cerrar();
        $intervencion->cerrar();

        $repository = $this->getDoctrine()->getRepository(EstadoIntervencion::class);
        $estadoRechazada = $repository->find(2);
        //creamos un nuevo item historico de intervencion
        $itemHistorico = new ItemHistoricoIntervencion();
        $itemHistorico->setEstadoIntervencion($estadoRechazada);
        $itemHistorico->setUser($this->getUser());
        $intervencion->addHistorialIntervencion($itemHistorico);

        return;
    }

    /* PAUSA UNA INTERVENCION*/
    public function PausarIntervencion(Intervencion $intervencion){
        //cerramos el último item histórico de intervención
        $intervencion->getHistorialIntervencion()->last()->cerrar();

        $repository = $this->getDoctrine()->getRepository(EstadoIntervencion::class);
        $estadoPausada = $repository->find(3);
        //creamos un nuevo item historico de intervencion
        $itemHistorico = new ItemHistoricoIntervencion();
        $itemHistorico->setEstadoIntervencion($estadoPausada);
        $itemHistorico->setUser($this->getUser());
        $intervencion->addHistorialIntervencion($itemHistorico);


        return;
    }

    /* CIERRA UNA INTERVENCION*/
    public function CerrarIntervencion(Intervencion $intervencion){
        //cerramos el último item histórico de intervención
        $intervencion->getHistorialIntervencion()->last()->cerrar();


        $repository = $this->getDoctrine()->getRepository(EstadoIntervencion::class);
        $estadoCerrada = $repository->find(4);
        //creamos un nuevo item historico de intervencion
        $itemHistorico = new ItemHistoricoIntervencion();
        $itemHistorico->setEstadoIntervencion($estadoCerrada);
        $itemHistorico->setUser($this->getUser());
        $intervencion->addHistorialIntervencion($itemHistorico);
        $intervencion->cerrar();

        return;
    }

    /* DEVUELVE EL TICKET A LA MESA DE AYUDA*/
    public function Devolver(Ticket $ticket, $obs){
        //creamos un nuevo historial de estados
        $hist = new ItemHistoricoEstados();

        //seteamos el usuario que devuelve el ticket
        $hist->setUser($this->getUser());

        //seteamos las observaciones declinaron el ticket
        $hist->setObservacion("el grupo de resolución ".$this->getUser()->getGrupoResolucion()->getNombre()." ".$obs);

        //buscamos y le asignamos la mesa de ayuda como grupo de resolución
        $repository = $this->getDoctrine()->getRepository(GrupoResolucion::class);
        $mesaDeAyuda = $repository->find(1);
        $hist->setGrupoResolucion($mesaDeAyuda);

        //buscamos el estado abierto sin derivar
        $repository = $this->getDoctrine()->getRepository(EstadoTicket::class);
        $estadoAbierto = $repository->find(1);
        $hist->setEstadoTicket($estadoAbierto);

        //como la clasificación no cambio el historial de estados sigue apuntando a la última clasificación
        $hist->setItemClasificacion($ticket->getLastHistorialClasificacion());

        $ticket->addHistorialEstado($hist);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($ticket);
        $entityManager->flush();
        return;

    }


    /* PONE EL TICKET EN ESTADO A LA ESPERA OK*/
    public function Terminar(Ticket $ticket){
        //creamos un nuevo historial de estados
        $hist = new ItemHistoricoEstados();

        //seteamos el usuario que devuelve el ticket
        $hist->setUser($this->getUser());

        $obs = "Cerro la intervención";

        //seteamos las observaciones declinaron el ticket
        $hist->setObservacion("el grupo de resolución ".$this->getUser()->getGrupoResolucion()->getNombre()." ".$obs);

        //buscamos y le asignamos la mesa de ayuda como grupo de resolución
        $repository = $this->getDoctrine()->getRepository(GrupoResolucion::class);
        $mesaDeAyuda = $repository->find(1);
        $hist->setGrupoResolucion($mesaDeAyuda);

        //buscamos el estado a la espera ok
        $repository = $this->getDoctrine()->getRepository(EstadoTicket::class);
        $estadoAbierto = $repository->find(3);
        $hist->setEstadoTicket($estadoAbierto);

        //como la clasificación no cambio el historial de estados sigue apuntando a la última clasificación
        $hist->setItemClasificacion($ticket->getLastHistorialClasificacion());

        $ticket->addHistorialEstado($hist);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($ticket);
        $entityManager->flush();
        return;

    }

    public function poseeIntervencionesAbiertas(Ticket $ticket){
        $intervenciones = $ticket->getIntervenciones();
        foreach ($intervenciones as $intevencion){
            $idE = $intevencion->getHistorialIntervencion()->last()->getEstadoIntervencion()->getId();
            if ($idE == 1 || $idE == 3){
                return true;
            }
        }
        return false;
    }
}
