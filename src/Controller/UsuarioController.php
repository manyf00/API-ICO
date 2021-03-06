<?php

namespace App\Controller;

use App\Repository\UsuariosRepository;
use App\Repository\HospitalRepository;
use App\Repository\MedicacionRepository;
use App\Repository\CitaRepository;
use App\Repository\PreguntaRepository;
use App\Repository\RespuestaRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UsuarioController
 * @package App\Controller
 *
 * @Route(path="/api/")
 */

class UsuarioController
{
    private $id=1;


    private $usuariosRepository;
    private $hospitalRepository;
    private $citaRepository;
    private $medicacionRepository;
    private $respuestaRepository;
    private $preguntaRepository;
    public function __construct(UsuariosRepository $usuariosRepository, HospitalRepository $hospitalRepository, CitaRepository $citaRepository, MedicacionRepository $medicacionRepository, PreguntaRepository $preguntaRepository , RespuestaRepository $respuestaRepository )
    {
        $this->usuariosRepository = $usuariosRepository;
        $this->hospitalRepository = $hospitalRepository;
        $this->citaRepository = $citaRepository;
        $this->medicacionRepository = $medicacionRepository;
        $this->respuestaRepository = $respuestaRepository;
        $this->preguntaRepository = $preguntaRepository;
    }
    /**
     * @Route("perfil", name="perfil", methods={"GET"})
     */
    public function getPerfil() : JsonResponse
    {

        $user = $this->usuariosRepository->findOneBy(['id' => $this->id]);
        $data=[
            
            'nombre'=>$user->getNombre(),
            'apellidos'=>$user->getApellidos(),
            'genero'=>$user->getGenero(),
            'correo'=>$user->getCorreo(),
            'telefonos'=>$user->getTelefonos(),
            'dataNaixement'=>$user->getDataNeixement(),
            'hospital'=>$user->getHospital()->getNombre(),
        ];
        
        return new JsonResponse($data, Response::HTTP_OK);
    }


    /**
     * @Route("hospital", name="hospital", methods={"GET"})
     */
    public function getHospital() : JsonResponse
    {

        $user = $this->usuariosRepository->findOneBy(['id'=>$this->id]);
        $hospital=$this->hospitalRepository->findOneBy(['id'=>$user->getHospital()]);
        $data=[
            'nombre'=>$hospital->getNombre(),
            'nombreUnidad'=>$hospital->getNombreUnidad(),
            'telefonos'=>$hospital->getTelefonos(),
            'diasAbiertos'=>$hospital->getDiasAbiertos(),
            'horaInicio'=>$hospital->getHoraInicio(),
            'horaFinal'=>$hospital->getHoraFinal(),
            'correos'=>$hospital->getCorreos(),
            'ubicacion'=>$hospital->getUbicacion(),
        ];
        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("citas", name="citas", methods={"GET"})
     */
    public function getCitas() : JsonResponse
    {
        $user = $this->usuariosRepository->findOneBy(['id'=>$this->id]);
        $citas=$user->getCitas();
        $data=[];
        foreach($citas as $cita){
            
            $data[]=[
                'id'=>$cita->getId(),
                'nombre'=>$cita->getNombre(),
                'fecha'=>$cita->getFecha(),
                'hora'=>$cita->getHora(),
                
            ];
    }
        return new JsonResponse($data, Response::HTTP_OK);
    }
    /**
     * @Route("cita/{id}", name="cita", methods={"GET"})
     */
    public function getCita($id) : JsonResponse
    {
        $cita=$this->citaRepository->findOneBy(['id'=>$id]);
            $data=[
                'id'=>$cita->getId(),
                'nombre'=>$cita->getNombre(),
                'fecha'=>$cita->getFecha(),
                'hora'=>$cita->getHora(),
                'edificio'=>$cita->getEdificio(),
                'box'=>$cita->getBox(),
                'indicaciones'=>$cita->getIndicaciones(),
                'estado'=>$cita->getEstado(),
                'hospital'=>$cita->getHospital()->getNombre(),
                'ubicacion'=>$cita->getHospital()->getUbicacion(),
            ];
        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("medicamentos", name="medicamentos", methods={"GET"})
     */
    public function getMedicamentos() : JsonResponse
    {
        $user = $this->usuariosRepository->findOneBy(['id'=>$this->id]);
        
        $medicamentos=$user->getMedicacions();
        foreach($medicamentos as $medicamento){
            $data[]=[
            'id'=>$medicamento->getId(),
            'nombre'=>$medicamento->getNombre(),
            'usosDiarios'=>$medicamento->getUsosDiarios(),
            'cantidad'=>$medicamento->getCantidad(),
            'tipoDeMedicamento'=>$medicamento->getTipo(),
        ];
    }
        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("medicamento/{id}", name="medicamento", methods={"GET"})
     */
    public function getMedicamento($id) : JsonResponse
    {
        $medicamento=$this->medicacionRepository->findOneBy(['id'=>$id]);
        $data=[
            'id'=>$medicamento->getId(),
            'nombre'=>$medicamento->getNombre(),
            'compuestoActivo'=>$medicamento->getCompuestoActivo(),
            'comprimidosTotales'=>$medicamento->getComprimidosTotales(),
            'usosDiarios'=>$medicamento->getUsosDiarios(),
            'dosis'=>$medicamento->getDosis(),
            'cantidad'=>$medicamento->getCantidad(),
            'tipoDeMedicamento'=>$medicamento->getTipo(),
            'observaciones'=>$medicamento->getObservaciones(),
        ];
        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("perfil", name="update_perfil", methods={"PUT"})
     */
    public function updatePerfil(Request $request): JsonResponse
    {
        $user = $this->usuariosRepository->findOneBy(['id'=>$this->id]);
        $data = json_decode($request->getContent(), true);

        empty($data['nombre']) ? true : $user->setNombre($data['nombre']);
        empty($data['apellidos']) ? true : $user->setApellidos($data['apellidos']);
        empty($data['genero']) ? true : $user->setGenero($data['genero']);
        empty($data['correo']) ? true : $user->setCorreo($data['correo']);
        empty($data['telefonos']) ? true : $user->setTelefonos($data['telefonos']);
        empty($data['dataNeixement']) ? true : $user->setDataNeixement(new \DateTime($data['dataNeixement']));
        $updatedUser = $this->usuariosRepository->updateUsuario($user);

		return new JsonResponse(['status' => 'Usuari actualitzat!'], Response::HTTP_OK);
    }


    /**
     * @Route("cita/{id}", name="update_cita", methods={"PUT"})
     */
    public function updateCita(Request $request): JsonResponse
    {
        $cita = $this->citaRepository->findOneBy(['id'=>$this->id]);
        $data = json_decode($request->getContent(), true);

        empty($data['fecha']) ? true : $cita->setFecha(new \DateTime($data['fecha']));
        empty($data['edificio']) ? true : $cita->setEdificio($data['edificio']);
        empty($data['box']) ? true : $cita->setBox($data['box']);
        empty($data['indicaciones']) ? true : $cita->setIndicaciones($data['indicaciones']);
        empty($data['estado']) ? true : $cita->setEstado($data['estado']);
        //falta hospital

        $updatedCita = $this->citaRepository->updateCita($cita);

		return new JsonResponse(['status' => 'Usuari actualitzat!'], Response::HTTP_OK);
    }

    /**
     * @Route("hospitales", name="all_hospitales", methods={"GET"})
     */
    public function getAllHospitales() : JsonResponse
    {
        $hospitales=$this->hospitalRepository->findAll();
           
        foreach($hospitales as $hospital){

            $data[]=[
                'id'=>$hospital->getId(),
                'nombre'=>$hospital->getNombre(),
                'nombreUnidad'=>$hospital->getNombreUnidad(),
                'telefonos'=>$hospital->getTelefonos(),
                'diasAbiertos'=>$hospital->getDiasAbiertos(),
                'horaInicio'=>$hospital->getHoraInicio(),
                'horaFinal'=>$hospital->getHoraFinal(),
                'correos'=>$hospital->getCorreos(),
                'ubicacion'=>$hospital->getUbicacion(),
                'provincia'=>$hospital->getProvincia(),
                'lineaBus'=>$hospital->getLineaBus(),
                'lineasMetro'=>$hospital->getLineasMetro(),
            ];
        }
        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("hospital/{provincia}", name="provincia_hospitales", methods={"GET"})
     */
    public function getProvinciaHospitales($provincia) : JsonResponse
    {
        $hospitales=$this->hospitalRepository->findBy(['provincia'=>$provincia]);;
           
        foreach($hospitales as $hospital){

            $data[]=[
                'id'=>$hospital->getId(),
                'nombre'=>$hospital->getNombre(),
                'nombreUnidad'=>$hospital->getNombreUnidad(),
                'telefonos'=>$hospital->getTelefonos(),
                'diasAbiertos'=>$hospital->getDiasAbiertos(),
                'horaInicio'=>$hospital->getHoraInicio(),
                'horaFinal'=>$hospital->getHoraFinal(),
                'correos'=>$hospital->getCorreos(),
                'ubicacion'=>$hospital->getUbicacion(),
                'provincia'=>$hospital->getProvincia(),
                'lineaBus'=>$hospital->getLineaBus(),
                'lineasMetro'=>$hospital->getLineasMetro(),
            ];
        }
        return new JsonResponse($data, Response::HTTP_OK);
    }



    /**
     * @Route("hospital", name="hospitalReferencia", methods={"GET"})
     */
    public function getHospitalReferencia() : JsonResponse
    {
        
        $user = $this->usuariosRepository->findOneBy(['id'=>$this->id]);
        $hospital=$user->getHospital();

            $data=[
                'id'=>$hospital->getId(),
                'nombre'=>$hospital->getNombre(),
                'nombreUnidad'=>$hospital->getNombreUnidad(),
                'telefonos'=>$hospital->getTelefonos(),
                'diasAbiertos'=>$hospital->getDiasAbiertos(),
                'horaInicio'=>$hospital->getHoraInicio(),
                'horaFinal'=>$hospital->getHoraFinal(),
                'correos'=>$hospital->getCorreos(),
                'ubicacion'=>$hospital->getUbicacion(),
                'provincia'=>$hospital->getProvincia(),
                'lineaBus'=>$hospital->getLineaBus(),
                'lineasMetro'=>$hospital->getLineasMetro(),
            ];
        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("preguntas", name="all_preguntas", methods={"GET"})
     */
    public function getAllPreguntas() : JsonResponse
    {
        $preguntas=$this->preguntaRepository->findAll();
           
        foreach($preguntas as $pregunta){

            $data[]=[
                'id'=>$pregunta->getId(),
                'nombre'=>$pregunta->getUsuario()->getNombre(),
                'apellido'=>$pregunta->getUsuario()->getApellidos(),
                'fecha'=>$pregunta->getFecha(),
                'pregunta'=>$pregunta->getPregunta(),
            ];
        }
        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("respuesta/{id}", name="respuesta", methods={"GET"})
     */
    public function getRespuesas($id) : JsonResponse
    {
        $pregunta=$this->preguntaRepository->findOneBy(['id'=>$id]);
        $respuetaPregunta=$pregunta->getRespuestas();
        
        foreach($respuetaPregunta as $respuesta){

            $respuestas[]=[
                'id'=>$respuesta->getId(),
                'nombre'=>$respuesta->getUsuario()->getNombre(),
                'apellido'=>$respuesta->getUsuario()->getApellidos(),
                'fecha'=>$respuesta->getFecha(),
                'respuesta'=>$respuesta->getTexto(),
            ];
        }
            $data=[
                'id'=>$pregunta->getId(),
                'nombre'=>$pregunta->getUsuario()->getNombre(),
                'apellido'=>$pregunta->getUsuario()->getApellidos(),
                'fecha'=>$pregunta->getFecha(),
                'pregunta'=>$pregunta->getPregunta(),
                'respuesta'=>$respuestas,
            ];
        
        return new JsonResponse($data, Response::HTTP_OK);
    }


    /**
     * @Route("pregunta", name="addPregunta", methods={"POST"})
     */
        public function addPregunta(Request $request): JsonResponse
        {
            $data = json_decode($request->getContent(), true);
            $user = $this->usuariosRepository->findOneBy(['id'=>$this->id]);
            $pregunta = $data['pregunta'];

            if (empty($pregunta)) {
                throw new NotFoundHttpException('Expecting mandatory parameters!');
            }

            $this->preguntaRepository->postPregunta($user,$pregunta);

            return new JsonResponse(['status' => 'pregunta creada'], Response::HTTP_CREATED);
        }

    /**
     * @Route("respuesta/{id}", name="addRespuesta", methods={"POST"})
     */
    public function addRespuesta($id,Request $request): JsonResponse
        {
            $pregunta=$this->preguntaRepository->findOneBy(['id'=>$id]);
            $data = json_decode($request->getContent(), true);
            $user = $this->usuariosRepository->findOneBy(['id'=>$this->id]);
            $respuesta = $data['respuesta'];

            if (empty($respuesta)) {
                throw new NotFoundHttpException('Expecting mandatory parameters!');
            }

            $this->respuestaRepository->postRespuesta($user,$pregunta,$respuesta);

            return new JsonResponse(['status' => 'respuesta creada'], Response::HTTP_CREATED);
        }
    /**
     * @Route("provincias", name="provincias", methods={"GET"})
     */
    public function getProvincias() : JsonResponse
    {
        $hospitales=$this->hospitalRepository->findAll();
        
        
        foreach($hospitales as $hospital){
            $provincias[]=[
                $hospital->getProvincia(),
            ];
        }
        $provincias = array_values(array_unique($provincias, SORT_REGULAR));
        foreach($provincias as $provincia){
            $data[]=[
                'provincia'=>$provincia,
            ];
        }
        return new JsonResponse($data, Response::HTTP_OK);
    }
}
