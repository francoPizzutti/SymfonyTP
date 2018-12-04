<?php

namespace App\Controller;

use App\Entity\EstadoIntervencion;
use App\Entity\EstadoTicket;
use App\Entity\GrupoResolucion;
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
        $gr = $this->getUser()->getGrupoResolucion();
        if ($this->getUser()!= null && $gr->getId()!=1) {
            $repository = $this->getDoctrine()->getRepository(EstadoIntervencion::class);
            $estados = $repository->findAll();
            $dto = $this->buildIntervencionDTO($id);

            return $this->render('GrupoDeResolucion/CU08ActualizarIntervencion.html.twig', [
                'load' => 'sacar()',
                'titulo' => 'Actualizar Intervención',
                'estados' => $estados,
                'dto' => $dto,
                'error' => $error
            ]);


        }
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



                $stat = $this->HeaderStat($result, 1, 5);
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


    public function Actualizar(Request $request, error $error){
        $gr = $this->getUser()->getGrupoResolucion();
        if ($this->getUser()!= null && $gr->getId()!=1) {
            //recuperamos los parametros enviados en el request
            $Nestado = $request->request->get('estado');
            $Nobservacion = $request->request->get('observacion');
            $Nticket =  $request->request->get('ticket');
            $Nintervencion =  $request->request->get('intervencion');

            if ($this->ValidaDescripcion($Nobservacion)){

            }
            else{
                $error->set('observacion', 'La descripcion no cumple con los requisitos');
                $repository = $this->getDoctrine()->getRepository(EstadoIntervencion::class);
                $estados = $repository->findAll();
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
}
