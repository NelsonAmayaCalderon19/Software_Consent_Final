<?php
class Cita{
    private $id;
    private $nombre_paciente;
    private $apellido_paciente;
    private $documento;
    private $tipo_documento;
    private $edad;
    private $plan_afiliacion;
    private $aseguradora;
    private $regimen;
    private $sexo;
    private $fecha;
    private $hora;
    private $ced_medico;
    private $consultorio;
    private $tipo_examen;
    private $cod_examen;
    private $sede;
    private $esquema_clinico;
    private $id_estado;

    public function __construct($nombre_paciente,$apellido_paciente,$documento,$tipo_documento,$edad,$plan_afiliacion,
    $aseguradora,$regimen,$sexo,$fecha,$hora,$ced_medico,$consultorio,$tipo_examen,$cod_examen,$sede,$id_estado,$esquema_clinico){
        $this->nombre_paciente = $nombre_paciente;
        $this->apellido_paciente = $apellido_paciente;
        $this->documento = $documento;
        $this->tipo_documento = $tipo_documento;
        $this->edad = $edad;
        $this->plan_afiliacion = $plan_afiliacion;
        $this->aseguradora = $aseguradora;
        $this->regimen = $regimen;
        $this->sexo = $sexo;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->ced_medico = $ced_medico;
        $this->consultorio = $consultorio;
        $this->tipo_examen = $tipo_examen;
        $this->cod_examen = $cod_examen;
        $this->sede = $sede;
        $this->id_estado = $id_estado;
        $this->esquema_clinico = $esquema_clinico;

    }
 
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getNombre_paciente()
    {
        return $this->nombre_paciente;
    }

    public function setNombre_paciente($nombre_paciente)
    {
        $this->nombre_paciente = $nombre_paciente;

        return $this;
    }
 
    public function getApellido_paciente()
    {
        return $this->apellido_paciente;
    }

    public function setApellido_paciente($apellido_paciente)
    {
        $this->apellido_paciente = $apellido_paciente;

        return $this;
    }
 
    public function getDocumento()
    {
        return $this->documento;
    }

    public function setDocumento($documento)
    {
        $this->documento = $documento;

        return $this;
    }
 
    public function getTipo_documento()
    {
        return $this->tipo_documento;
    }

    public function setTipo_documento($tipo_documento)
    {
        $this->tipo_documento = $tipo_documento;

        return $this;
    }
 
    public function getEdad()
    {
        return $this->edad;
    }

    public function setEdad($edad)
    {
        $this->edad = $edad;

        return $this;
    }

    public function getPlan_afiliacion()
    {
        return $this->plan_afiliacion;
    }
 
    public function setPlan_afiliacion($plan_afiliacion)
    {
        $this->plan_afiliacion = $plan_afiliacion;

        return $this;
    }

    public function getAseguradora()
    {
        return $this->aseguradora;
    }

    public function setAseguradora($aseguradora)
    {
        $this->aseguradora = $aseguradora;

        return $this;
    }

    public function getSexo()
    {
        return $this->sexo;
    }

    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }
 
    public function getHora()
    {
        return $this->hora;
    }

    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }

    public function getCed_medico()
    {
        return $this->ced_medico;
    }

    public function setCed_medico($ced_medico)
    {
        $this->ced_medico = $ced_medico;

        return $this;
    }

    public function getConsultorio()
    {
        return $this->consultorio;
    }

    public function setConsultorio($consultorio)
    {
        $this->consultorio = $consultorio;

        return $this;
    }

    public function getTipo_examen()
    {
        return $this->tipo_examen;
    }

    public function setTipo_examen($tipo_examen)
    {
        $this->tipo_examen = $tipo_examen;

        return $this;
    }

    public function getCod_examen()
    {
        return $this->cod_examen;
    }

    public function setCod_examen($cod_examen)
    {
        $this->cod_examen = $cod_examen;

        return $this;
    }
 
    public function getSede()
    {
        return $this->sede;
    }

    /**
     * Set the value of sede
     *
     * @return  self
     */ 
    public function setSede($sede)
    {
        $this->sede = $sede;

        return $this;
    }

    public function getEsquema_clinico()
    {
        return $this->esquema_clinico;
    }

    public function setEsquema_clinico($esquema_clinico)
    {
        $this->esquema_clinico = $esquema_clinico;

        return $this;
    }

    public function getId_estado()
    {
        return $this->id_estado;
    }

    public function setId_estado($id_estado)
    {
        $this->id_estado = $id_estado;

        return $this;
    }

    public function getRegimen()
    {
        return $this->regimen;
    }

    public function setRegimen($regimen)
    {
        $this->regimen = $regimen;

        return $this;
    }
}
 ?>