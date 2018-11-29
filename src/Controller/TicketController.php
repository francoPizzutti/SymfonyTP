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
use App\Service\clasificacionesDTO;
use App\Service\estadosDTO;
use App\Service\gruposDTO;
use App\Service\historicoDTO;
use App\Service\usuarioDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Tests\Compiler\E;
use Symfony\Component\HttpFoundation\Request;
use App\Service\error;
use App\Service\requestflash;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ticketDTO;

/* Componentes de validacion*/
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
/* #END# componentes de validacion*/


class TicketController extends AbstractController
{

    /** ################################################################################################################## */
    /*---------------FUNCIONES PARA LA PRESENTACION DE LAS VISTAS----------------------------------------------------------*
    /** ################################################################################################################## */

    /* PRESENTA LA VISTA CON EL FORMULARIO PARA EL REGISTRO DE UN NUEVO TICKET*/
    public function VistaRegistrar(error $error, requestflash $requestflash){
        if ($this->getUser()!= null && $this->getUser()->getNivel()==0) {
            $titulo = 'Registrar Nuevo Ticket';
            $load = '';
            $fecha = date("Y-m-d");
            $hora = date("h:i:s");

            $requestflash->set($this->getLastTicket()+1);
            $clasificacionesDTO = $this->clasificacionesOrdenadas();

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


    /* PRESENTA LA VISTA CON EL FORMULARIO PARA CONSULTAR TICKET*/
    public function VistaConsultar(){
        if ($this->getUser()!= null) {
            $titulo = 'Consultar Ticket';
            $load = '';
            $clasificaciones = $this->clasificacionesOrdenadas();
            $claDTO = new clasificacionesDTO();
            $claDTO->setId(0);
            $claDTO->setNombre('Todas las clasificaciones');
            array_unshift($clasificaciones, $claDTO);
            $grupos = $this->gruposOrdenados();
            $gruDTO = new gruposDTO();
            $gruDTO->setId(0);
            $gruDTO->setNombre('Todos los grupos de resolución');
            array_unshift($grupos, $gruDTO);
            $estados = $this->estadosOrdenados();
            $estDTO = new estadosDTO();
            $estDTO->setId(0);
            $estDTO->setDescripcion('Todos los estados');
            array_unshift($estados, $estDTO);
            return $this->render('MesaDeAyuda/CU02ConsultarTicket.html.twig', [
                'titulo' => $titulo,
                'load' => $load,
                'grupos' => $grupos,
                'estados' => $estados,
                'clasificaciones' => $clasificaciones
            ]);

        }
        else return $this->redirectToRoute('index');

    }

    /* PRESENTA LA VISTA CON EL DETALLE DE UN TICKET SELECCIONADO*/
    public function VerDetalleTicket($id){
        if ($this->getUser()!= null) {
            $titulo = 'Detalle de Ticket';
            $btnD="disabled";
            $btnC="disabled";
            $load = 'onload=sacar()';

            //BUSCAMOS EL TICKET
            $repository = $this->getDoctrine()->getRepository(Ticket::class);
            $Ticket = $repository->find($id);
            //Seteamos los botones
            if($Ticket->getLastHistorialEstados()->getEstadoTicket()->getId()==1)$btnD="";
            if($Ticket->getLastHistorialEstados()->getEstadoTicket()->getId()==3)$btnC="";
            $usuarioDTO = $this->buildUsuarioDTO($Ticket);
            $historial = $this->buildHistoricoDTO($Ticket);



            return $this->render('MesaDeAyuda/CU02ConsultarTicket3.html.twig', [
                'titulo' => $titulo,
                'load' => $load,
                'idTicket'=>$id,
                'btnDerivar' => $btnD,
                'btnCerrar' => $btnC,
                'empleado' => $usuarioDTO,
                'historial' => $historial
            ]);

        }
        else return $this->redirectToRoute('index');

    }




    /** ################################################################################################################## */
    /*---------------PROCESAMIENTO DE FORMULARIOS--------------------------------------------------------------------------*
    /** ################################################################################################################## */

    /* PROCESA EL FORMULARIO DE REGISTRO DE REGISTRACION DE TICKET*/
    public function Registrar(Request $request, error $error, requestflash $requestflash){


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


           $clasificacionesDTO = $this->clasificacionesOrdenadas();
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

           /* BUSCAMOS LA MESA DE AYUDA */
           $repository = $this->getDoctrine()->getRepository(GrupoResolucion::class);
           $mesaAyuda = $repository->find(1);

           /*CREAMOS Y SETEAMOS EL ITEM HISTORICO DE RECLASIFICACION*/
           $hr = new ItemHistoricoClasificacion();
           $hr->setUser($usuario);
           $hr->setClasificacion($clasificacion);
           /* #END# ITEM HISTORICO DE RECLASIFICACION*/

           /*CREAMOS Y SETEAMOS EL ITEM HISTORICO DE ESTADOS*/
           $he = new ItemHistoricoEstados();
           $he->setUser($usuario);
           $he->setEstadoTicket($estado);
           $he->setItemClasificacion($hr);
           $he->setGrupoResolucion($mesaAyuda);
           /* #END# ITEM HISTORICO DE ESTADOS */





           /*AGREGAMOS LOS HISTORIALES AL TICKET*/
           $ticket->addHistorialEstado($he);
           $ticket->addHistorialClasificacione($hr);
           /* #END# ADD HISTORIALES*/

           /* CREAMOS LA INTERVENCION PARA LA MESA DE AYUDA*/
           $repository = $this->getDoctrine()->getRepository(EstadoIntervencion::class);
           $estadoInt = $repository->find(4);

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

    /* PROCESA EL FORMULARIO PARA CERRAR UN TICKET EN MESA DE AYUDA*/
    public function CU01CerrarMesa(Request $request, requestflash $requestflash, error $error){

        if ($this->getUser()!= null && $this->getUser()->getNivel()==0) {
            /* recuperamos los datos enviados en el formulario*/
            $NTicket = $request->request->get('idTicket');
            $Nobservacion = $request->request->get('observacion');

            /* #END# datos del formulario */

            /* EN CASO DE QUE LOS PARAMETROS NO CUMPLAN CON LOS REQUERIMIENTOS RETORNA LA VISTA CON ERROR */
            if (!$this->ValidaDescripcion($Nobservacion) || !$this->ValidaTicket($NTicket)) {

                if($this->ValidaDescripcion($Nobservacion)==false){
                    $error->set('observacion', 'Las observaciones no cumplen con los requerimientos min 3 caracteres, max 255');

                }
                if($this->ValidaTicket($NTicket)==false){
                    $error->set('ticket', 'El ticket es inexistente');

                }
                $requestflash->set($NTicket);
                $requestflash->set($Nobservacion);
                $load = 'errorNotify("El Ticket con el Nro: '.$NTicket.', no pudo ser cerrado")';
                return $this->render('MesaDeAyuda/CU01registrarticket2.html.twig', ['load' => $load,
                    'titulo' => 'Error Acciones Requeridas',
                    'error' =>$error,
                    'requestflash' => $requestflash]);

            }
            else{
                $entityManager = $this->getDoctrine()->getManager();
                /* BUSCAMOS EL TICKET  QUE SERA CERRADO*/
                $repository = $this->getDoctrine()->getRepository(Ticket::class);
                $ticket = $repository->findOneBy(['Nro_Ticket'=> $NTicket]);
                /* #END* buscar */

                /* BUSCAMOS AHORA EL USUARIO */
                $usuario = $this->getUser();
                /* #END# buscar usuario*/

                $this->cerrarIntervencionMesa($ticket, $Nobservacion, $usuario);
                $this->cerrarHistorialesTicket($ticket, $usuario, $Nobservacion);

                $entityManager->persist($ticket);

                $entityManager->flush();

                $load = 'success("El Ticket fue cerrado correctamente")';
                $requestflash->set($NTicket);
                $requestflash->set($Nobservacion);


                return $this->render('MesaDeAyuda/CU01registrarticket2.html.twig', ['load' => $load,
                    'titulo' => 'Ticket Cerrado',

                    'error' =>$error,

                    'requestflash' => $requestflash]);

            }
        }
        else return $this->redirectToRoute('index');


    }


    /* PROCESA EL FORMULARIO DE CONSULTA DE TICKET*/
    public function Consultar(Request $request, requestflash $requestflash,error $error){


        if ($this->getUser()!= null && $this->getUser()->getNivel()==0) {
            /* recuperamos los datos enviados en el formulario*/
            $Nticket = $request->request->get('idTicket');
            $Nlegajo = $request->request->get('legajo');
            $Nclasificacion = $request->request->get('clasificacion');
            $Nestado = $request->request->get('estado');
            $Ngrupo = $request->request->get('grupoRes');
            $NfechaC = $request->request->get('fechaCreacion');
            $NfechaU = $request->request->get('fechaCambio');
            $Ne = null;
            /* #END# datos del formulario */

            /* creamos el DTO para enviar a la vista con lso datos del formulario*/
            $requestflash->set($Nticket);
            $requestflash->set($Nlegajo);
            if($Nestado != 0){
                $repository = $this->getDoctrine()->getRepository(EstadoTicket::class);
                $estadoTicket = $repository->find($Nestado);
                $requestflash->set($estadoTicket->getDescripcion());
            }else{
                $requestflash->set('Todos los estados');
            }

            if($Nclasificacion != 0){
                $repository = $this->getDoctrine()->getRepository(ClasificacionTicket::class);
                $clasificacion = $repository->find($Nclasificacion);
                $requestflash->set($clasificacion->getNombre());
            }else{
                $requestflash->set('Todas las clasificaciones');
            }
            if($Ngrupo != 0){
                $repository = $this->getDoctrine()->getRepository(GrupoResolucion::class);
                $grupoR = $repository->find($Ngrupo);
                $requestflash->set($grupoR->getNombre());
            }else{
                $requestflash->set('Todos los grupos de resolucion');
            }
            $requestflash->set($NfechaC);
            $requestflash->set($NfechaU);
            /* #END# DTO para la vista*/


            if($this->ValidaLegajo($Nlegajo)) {
                /*BUSCAMOS EL EMPLEADO*/
                $repository = $this->getDoctrine()->getRepository(Empleado::class);
                $empleado = $repository->findBy(['Legajo' => $Nlegajo]);/* #END# EMPLEADO*/;
                $Ne=$empleado[0]->getId();

            }else{
                $error->set('legajo', 'El legajo es invalido');
            }


            $result = $this->getDoctrine()
                ->getRepository(Ticket::class)
                ->consult($Nticket, $Ne, $NfechaC, $Nclasificacion, $Nestado, $NfechaU, $Ngrupo);

            if ($result!=null){



                $stat = $this->HeaderStat($result, 3, 4);
                $resultDTO = $this->buildTicketDTO($result);


                return $this->render('MesaDeAyuda/CU02ConsultarTicket2.html.twig',['titulo' => 'Resultados obtenidos',
                    'load' => 'sacar()',
                    'stat' => $stat,
                    'requestflash' => $requestflash,
                    'resultado' => $resultDTO,
                ]);
            }
            else{
                return $this->render('MesaDeAyuda/CU02ConsultarTicket2.html.twig',['titulo' => 'fallo',
                    'load' => 'sacar()',
                    'stat' => [0,0,0,0],
                    'requestflash' => $requestflash,
                    'resultado' => 'nada de nada',
                ]);
            }


        }




    }





    /** ################################################################################################################## */
    /*---------------VALIDACIONES------------------------------------------------------------------------------------------*
    /** ################################################################################################################## */

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

    /* VALIDA UN NUMERO DE LEGAJO*/
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

    /* VALIDA UN NUMERO INGRESADO COMO UNA CLASIFICACION DE TICKET*/
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

    /* VALIDA SI UN NUMERO INGRESADO CORRESPONDE A UN TICKET*/
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


    /** ################################################################################################################## */
    /*---------------FUNCIONES AUXILIARES PARA EL MAQUETEADO DE LAS VISTAS-------------------------------------------------*
    /** ################################################################################################################## */

    /* PERMITE ENCONTRAR EL ULTIMO TICKET, SIRVE PARA CREAR UN NUEVO TICKET */
    public function getLastTicket(){
        $last = $this->getDoctrine()
            ->getRepository(Ticket::class)
            ->lastT();

        if($last != null) {

            return $last[0]->getNroTicket();
        }
        else  return 0;

    }


    /* TRAE TODAS LAS CLASIFICACION EN FORMA ORDENADAS ALFABETICAMENTE POR NOMBRE */
    public function clasificacionesOrdenadas(){
        $repository = $this->getDoctrine()->getRepository(ClasificacionTicket::class);
        $clas = $repository->findBy(
            [],
            ['Nombre' => 'ASC']
        );
        $clasificaciones = array();
        foreach ($clas as $item){
            $claDTO = new clasificacionesDTO();
            $claDTO->setId($item->getId());
            $claDTO->setNombre($item->getNombre());
            array_push($clasificaciones, $claDTO);

        }
        return $clasificaciones;

    }

    /* TRAE TODOS LOS GRUPOS DE RESOLUCION ORDENADOS ALFABETICAMENTE POR NOMBRE */
    public function gruposOrdenados(){
        $repository = $this->getDoctrine()->getRepository(GrupoResolucion::class);
        $gruposO = $repository->findBy(
            [],
            ['Nombre' => 'ASC']
        );
        $grupos = array();
        foreach ($gruposO as $item){
            $grupoDTO = new gruposDTO();
            $grupoDTO->setId($item->getId());
            $grupoDTO->setNombre($item->getNombre());
            array_push($grupos, $grupoDTO);

        }
        return $grupos;

    }

    /* TRAE TODOS LOS ESTADOS DE TICKET ORDENADOS ALFABETICAMENTE POR DESCRIPCION */
    public function estadosOrdenados(){
        $repository = $this->getDoctrine()->getRepository(EstadoTicket::class);
        $estadosO = $repository->findBy(
            [],
            ['Descripcion' => 'ASC']
        );
        $estados = array();
        foreach ($estadosO as $item){
            $estadoDTO = new estadosDTO();
            $estadoDTO->setId($item->getId());
            $estadoDTO->setDescripcion($item->getDescripcion());
            array_push($estados, $estadoDTO);

        }
        return $estados;

    }

    /* ARMA EL HEADER CON TODAS LAS ESTADISTICAS DE LA BUSQUEDA*/
    public function HeaderStat($arrayResult, $idEstado, $idEstado2){
        $repository = $this->getDoctrine()->getRepository(EstadoTicket::class);
        $Estado1 = $repository->find($idEstado);
        $Estado2 = $repository->find($idEstado2);
        $ct = count($arrayResult);
        $arrL = array();
        $E = 0;
        $C=0;
        foreach ($arrayResult as $a){
            array_push($arrL, $a->getEmpleado()->getLegajo());
            if($a->getHistorialEstados()->last()->getEstadoTicket() == $Estado1)$E++;
            if($a->getHistorialEstados()->last()->getEstadoTicket() == $Estado2)$C++;

        }
        $legajos = array_unique($arrL);
        return array(count($arrayResult), count($legajos), $E, $C);
    }

    /* CONSTRUYE EL ARRAY DE TICKETDTO PARA ENVIAR A LA VISTA*/
    public function buildTicketDTO($result){
        $arrayDTO = array();
        foreach ($result as $ticket){
            $dto = new ticketDTO();
            $dto->setId($ticket->getId());
            $dto->setClasificacion($ticket->getLastHistorialClasificacion()->getClasificacion()->getNombre());
            $dto->setEstado($ticket->getLastHistorialEstados()->getEstadoTicket()->getDescripcion());
            $dto->setFechaApertura($ticket->getFechaString());
            $dto->setFechaUltimoCambio($ticket->getLastHistorialEstados()->getFechaDesdeString());
            $dto->setGrupoResolucion($ticket->getLastHistorialEstados()->getGrupoResolucion()->getNombre());
            $dto->setLegajo($ticket->getEmpleado()->getLegajo());
            $dto->setUsuario("".$ticket->getUser()->getEmpleado()->getNombre()." ".$ticket->getUser()->getEmpleado()->getApellido());
            array_push($arrayDTO, $dto);
        }
        return $arrayDTO;

    }

    /* CONSTRUYE UN OBJETO DE TIPO USUARIO DTO PARA EL ENVIO DEL DETALLE DE TICKET*/
    public function buildUsuarioDTO(ticket $ticket){
        $usrDTO = new usuarioDTO();
        $usrDTO->setLegajo($ticket->getEmpleado()->getLegajo());
        $usrDTO->setApellido($ticket->getEmpleado()->getApellido());
        $usrDTO->setCalle($ticket->getEmpleado()->getDireccion()->getCalle());
        $usrDTO->setCargo($ticket->getEmpleado()->getCargo()->getDescripcion());
        $usrDTO->setNombre($ticket->getEmpleado()->getNombre());
        $usrDTO->setNumero($ticket->getEmpleado()->getDireccion()->getNumero());
        $usrDTO->setOficina($ticket->getEmpleado()->getDireccion()->getOficina());
        $usrDTO->setPiso($ticket->getEmpleado()->getDireccion()->getPiso());
        $usrDTO->setTelDirecto($ticket->getEmpleado()->getTelefonoDirecto());
        $usrDTO->setTelInterno($ticket->getEmpleado()->getTelefonoInterno());

        return $usrDTO;

    }

    /* CONSTRUYE UN ARRAY CON EL DETALLE HISTORICO DEL TICKET*/
    public function buildHistoricoDTO(ticket $ticket){
        $arrayDTO = array();
        foreach ($ticket->getHistorialEstados() as $itemHE){
            $itemDTO = new historicoDTO();
            $itemDTO->setUsuario("".$itemHE->getUser()->getEmpleado()->getNombre()." ".$itemHE->getUser()->getEmpleado()->getApellido());
            $itemDTO->setEstado($itemHE->getEstadoTicket()->getDescripcion());
            $itemDTO->setFecha($itemHE->getFechaDesdeString());
            $itemDTO->setHora($itemHE->getHoraDesdeString());
            $itemDTO->setObservaciones($itemHE->getObservacion());
            $itemDTO->setGrupo($itemHE->getGrupoResolucion()->getNombre());
            $itemDTO->setClasificacion($itemHE->getItemClasificacion()->getClasificacion()->getNombre());
            array_push($arrayDTO, $itemDTO);

        }
        return $arrayDTO;
    }


    /** ################################################################################################################## */
    /*---------------FUNCIONES AUXILIARES PARA EL PROCESAMIENTO DE FORMULARIOS----------------------------------------------*
    /** ################################################################################################################## */



    public function cerrarIntervencionMesa( Ticket $ticket, $obs, $user){
        /* Buscamos la intervencion de la mesa de ayuda*/
        $interMesa = $ticket->getIntervenciones()->first();

        /* seteamos las observaciones*/
        $interMesa->setObservaciones($obs);

        /* buscamos el item historico de la intervencion y lo cerramos*/
        $historialMesa = $interMesa->getHistorialIntervencion()->first();
        $historialMesa->cerrar();

        /* buscamos el estado cerrado de la intervencion desde la base de datos*/
        $repository = $this->getDoctrine()->getRepository(EstadoIntervencion::class);
        $EstadoIntervencion = $repository->find(5);

        /* creamos el nuevo item historico de intervencion y le seteamos el usuario y el nuevo estado cerrado*/
        $historialNuevo = new ItemHistoricoIntervencion();
        $historialNuevo->setUser($user);
        $historialNuevo->setEstadoIntervencion($EstadoIntervencion);
        $historialNuevo->cerrar();

        /* agregamos el nuevo item historico a la intervencion, y por ende al ticket*/
        $interMesa->addHistorialIntervencion($historialNuevo);

    }

    public function cerrarHistorialesTicket( Ticket $ticket, $user, $obs){
        /* Buscamos el ultimo historial de estados y lo cerramos*/
        $historialEstados = $ticket->getHistorialEstados()->last();
        $historialEstados->cerrar($obs);

        /* buscamos el nuevo estado cerrado para el nuevo historial de estados*/
        $repository = $this->getDoctrine()->getRepository(EstadoTicket::class);
        $estadoTicket = $repository->find(4);

        /* buscamos la mesa de ayuda que es el grupo de resolucion que cierra el ticket*/
        $repository = $this->getDoctrine()->getRepository(GrupoResolucion::class);
        $mesaAyuda = $repository->find(1);

        /* cerramos el historial de reclasificacion*/
        $historialclasificacion = $ticket->getHistorialClasificaciones()->last();
        $historialclasificacion->cerrar();

        /* creamos el nuevo historial de estados y le seteamos el usuario y el nuevo estado cerrado del ticket*/
        $historialNuevo = new ItemHistoricoEstados();
        $historialNuevo->setUser($user);
        $historialNuevo->setEstadoTicket($estadoTicket);
        $historialNuevo->setItemClasificacion($historialclasificacion);
        $historialNuevo->setGrupoResolucion($mesaAyuda);
        $historialNuevo->cerrar($obs);

        /* agregamos el nuevo historial al ticket*/
        $ticket->addHistorialEstado($historialNuevo);




    }

    public function getClasificacion(Ticket $ticket, $date){
        if(count($ticket->getHistorialClasificaciones()) == 1){
            return $ticket->getLastHistorialClasificacion()->getClasificacion();
        }
        else{
            $hc = $ticket->getHistorialClasificaciones();
            $i = 0;
            $fechaAux = $hc[0]->getFechaDesde();
            $clasificacion = $hc[0]->getClasificacion();
            while ($fechaAux < $date){
                $i++;
                $fechaAux = $hc[$i]->getFechaDesde();
                $clasificacion = $hc[$i]->getClasificacion();
            }
            return $clasificacion;

        }
    }


    public function getGrupoResolucion(Ticket $ticket)
    {
        $repository = $this->getDoctrine()->getRepository(GrupoResolucion::class);
        $intv=null;
        if($ticket->getLastHistorialEstados()->getEstadoTicket()->getId()!= 2 )
        {
            $grupo = $repository->find(1);
            return $grupo;

        }
        else{
            foreach ($ticket->getIntervenciones() as $intervencion) {
                $Itemhist = $intervencion->getHistorialIntervencion()->last();
                if($Itemhist->getEstadoIntervencion()->getId() == 1 || $Itemhist->getEstadoIntervencion()->getId() == 4){
                    $intv = $intervencion->getGrupoResolucion();
                }
            }

            return $intv;
        }
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
