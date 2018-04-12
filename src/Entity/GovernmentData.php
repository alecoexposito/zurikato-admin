<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GovernmentData
 *
 * @ORM\Table(name="government_data")
 * @ORM\Entity
 */
class GovernmentData
{
    /**
     * @return Device
     */
    public function getDevice()
    {
        return $this->device;
    }

    /**
     * @param Device $device
     * @return GovernmentData
     */
    public function setDevice($device)
    {
        $this->device = $device;
        return $this;
    }

    /**
     * @ORM\OneToOne(targetEntity="Device", inversedBy="governmentData")
     * @ORM\JoinColumn(name="government_data_id", referencedColumnName="idDevice")
     */
    private $device;

    /**
     * @var string
     *
     * @ORM\Column(name="empresa", type="string", length=100)
     */
    private $empresa;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreRuta", type="string", length=30)
     */
    private $nombreRuta;

    /**
     * @var string
     *
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_economico", type="string", length=30)
     */
    private $numeroEconomico;


    /**
     * @var string
     *
     * @ORM\Column(name="placas", type="string", length=30)
     */
    private $placas;

    /**
     * @var string
     *
     * @ORM\Column(name="imei", type="string", length=50)
     */
    private $imei;

    /**
     * @var float
     *
     * @ORM\Column(name="latitud", type="float")
     */
    private $latitud;

    /**
     * @var float
     *
     * @ORM\Column(name="longitud", type="float")
     */
    private $longitud;

    /**
     * @var float
     *
     * @ORM\Column(name="altitud", type="float")
     */
    private $altitud;

    /**
     * @var float
     *
     * @ORM\Column(name="velocidad", type="float")
     */
    private $velocidad;

    /**
     * @var float
     *
     * @ORM\Column(name="direccion", type="float", nullable=true)
     */
    private $direccion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="boton_panico", type="boolean")
     */
    private $boton_panico;

    /**
     * @var string
     *
     * @ORM\Column(name="url_camara", type="string", length=4000, nullable=true)
     */
    private $urlCamara;

    /**
     * @var integer
     *
     * @ORM\Column(name="pasajerosAbordo", type="integer", nullable=true)
     */
    private $pasajerosAbordo;

    /**
     * @var integer
     *
     * @ORM\Column(name="acumulado_subidas", type="integer", nullable=true)
     */
    private $acumuladoSubidas;

    /**
     * @var integer
     *
     * @ORM\Column(name="acumulado_bajadas", type="integer", nullable=true)
     */
    private $acumuladoBajadas;

    /**
     * @var integer
     *
     * @ORM\Column(name="pasajeros_subieron_p_delantera", type="integer", nullable=true)
     */
    private $pasajerosSubieronPDelantera;

    /**
     * @var integer
     *
     * @ORM\Column(name="pasajeros_subieron_p_trasera", type="integer", nullable=true)
     */
    private $pasajerosSubieronPTrasera;

    /**
     * @var integer
     *
     * @ORM\Column(name="pasajeros_bajaron_p_delantera", type="integer", nullable=true)
     */
    private $pasajerosBajaronPDelantera;

    /**
     * @var integer
     *
     * @ORM\Column(name="pasajerosBajaronPTrasera", type="integer", nullable=true)
     */
    private $pasajerosBajaronPTrasera;

    /**
     * @var integer
     *
     * @ORM\Column(name="bloqueos_p_delantera", type="integer", nullable=true)
     */
    private $bloqueosPDelantera;

    /**
     * @var integer
     *
     * @ORM\Column(name="bloqueos_p_trasera", type="integer", nullable=true)
     */
    private $bloqueosPTrasera;


    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return GovernmentData
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * @param string $empresa
     * @return GovernmentData
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;
        return $this;
    }

    /**
     * @return string
     */
    public function getNombreRuta()
    {
        return $this->nombreRuta;
    }

    /**
     * @param string $nombreRuta
     * @return GovernmentData
     */
    public function setNombreRuta($nombreRuta)
    {
        $this->nombreRuta = $nombreRuta;
        return $this;
    }

    /**
     * @return string
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param string $fecha
     * @return GovernmentData
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
        return $this;
    }

    /**
     * @return string
     */
    public function getNumeroEconomico()
    {
        return $this->numeroEconomico;
    }

    /**
     * @param string $numeroEconomico
     * @return GovernmentData
     */
    public function setNumeroEconomico($numeroEconomico)
    {
        $this->numeroEconomico = $numeroEconomico;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlacas()
    {
        return $this->placas;
    }

    /**
     * @param string $placas
     * @return GovernmentData
     */
    public function setPlacas($placas)
    {
        $this->placas = $placas;
        return $this;
    }

    /**
     * @return string
     */
    public function getImei()
    {
        return $this->imei;
    }

    /**
     * @param string $imei
     * @return GovernmentData
     */
    public function setImei($imei)
    {
        $this->imei = $imei;
        return $this;
    }

    /**
     * @return float
     */
    public function getLatitud()
    {
        return $this->latitud;
    }

    /**
     * @param float $latitud
     * @return GovernmentData
     */
    public function setLatitud($latitud)
    {
        $this->latitud = $latitud;
        return $this;
    }

    /**
     * @return float
     */
    public function getLongitud()
    {
        return $this->longitud;
    }

    /**
     * @param float $longitud
     * @return GovernmentData
     */
    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;
        return $this;
    }

    /**
     * @return float
     */
    public function getAltitud()
    {
        return $this->altitud;
    }

    /**
     * @param float $altitud
     * @return GovernmentData
     */
    public function setAltitud($altitud)
    {
        $this->altitud = $altitud;
        return $this;
    }

    /**
     * @return float
     */
    public function getVelocidad()
    {
        return $this->velocidad;
    }

    /**
     * @param float $velocidad
     * @return GovernmentData
     */
    public function setVelocidad($velocidad)
    {
        $this->velocidad = $velocidad;
        return $this;
    }

    /**
     * @return float
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param float $direccion
     * @return GovernmentData
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
        return $this;
    }

    /**
     * @return bool
     */
    public function isBotonPanico()
    {
        return $this->boton_panico;
    }

    /**
     * @param bool $boton_panico
     * @return GovernmentData
     */
    public function setBotonPanico($boton_panico)
    {
        $this->boton_panico = $boton_panico;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrlCamara()
    {
        return $this->urlCamara;
    }

    /**
     * @param string $urlCamara
     * @return GovernmentData
     */
    public function setUrlCamara($urlCamara)
    {
        $this->urlCamara = $urlCamara;
        return $this;
    }

    /**
     * @return int
     */
    public function getPasajerosAbordo()
    {
        return $this->pasajerosAbordo;
    }

    /**
     * @param int $pasajerosAbordo
     * @return GovernmentData
     */
    public function setPasajerosAbordo($pasajerosAbordo)
    {
        $this->pasajerosAbordo = $pasajerosAbordo;
        return $this;
    }

    /**
     * @return int
     */
    public function getAcumuladoSubidas()
    {
        return $this->acumuladoSubidas;
    }

    /**
     * @param int $acumuladoSubidas
     * @return GovernmentData
     */
    public function setAcumuladoSubidas($acumuladoSubidas)
    {
        $this->acumuladoSubidas = $acumuladoSubidas;
        return $this;
    }

    /**
     * @return int
     */
    public function getAcumuladoBajadas()
    {
        return $this->acumuladoBajadas;
    }

    /**
     * @param int $acumuladoBajadas
     * @return GovernmentData
     */
    public function setAcumuladoBajadas($acumuladoBajadas)
    {
        $this->acumuladoBajadas = $acumuladoBajadas;
        return $this;
    }

    /**
     * @return int
     */
    public function getPasajerosSubieronPDelantera()
    {
        return $this->pasajerosSubieronPDelantera;
    }

    /**
     * @param int $pasajerosSubieronPDelantera
     * @return GovernmentData
     */
    public function setPasajerosSubieronPDelantera($pasajerosSubieronPDelantera)
    {
        $this->pasajerosSubieronPDelantera = $pasajerosSubieronPDelantera;
        return $this;
    }

    /**
     * @return int
     */
    public function getPasajerosSubieronPTrasera()
    {
        return $this->pasajerosSubieronPTrasera;
    }

    /**
     * @param int $pasajerosSubieronPTrasera
     * @return GovernmentData
     */
    public function setPasajerosSubieronPTrasera($pasajerosSubieronPTrasera)
    {
        $this->pasajerosSubieronPTrasera = $pasajerosSubieronPTrasera;
        return $this;
    }

    /**
     * @return int
     */
    public function getPasajerosBajaronPDelantera()
    {
        return $this->pasajerosBajaronPDelantera;
    }

    /**
     * @param int $pasajerosBajaronPDelantera
     * @return GovernmentData
     */
    public function setPasajerosBajaronPDelantera($pasajerosBajaronPDelantera)
    {
        $this->pasajerosBajaronPDelantera = $pasajerosBajaronPDelantera;
        return $this;
    }

    /**
     * @return int
     */
    public function getPasajerosBajaronPTrasera()
    {
        return $this->pasajerosBajaronPTrasera;
    }

    /**
     * @param int $pasajerosBajaronPTrasera
     * @return GovernmentData
     */
    public function setPasajerosBajaronPTrasera($pasajerosBajaronPTrasera)
    {
        $this->pasajerosBajaronPTrasera = $pasajerosBajaronPTrasera;
        return $this;
    }

    /**
     * @return int
     */
    public function getBloqueosPDelantera()
    {
        return $this->bloqueosPDelantera;
    }

    /**
     * @param int $bloqueosPDelantera
     * @return GovernmentData
     */
    public function setBloqueosPDelantera($bloqueosPDelantera)
    {
        $this->bloqueosPDelantera = $bloqueosPDelantera;
        return $this;
    }

    /**
     * @return int
     */
    public function getBloqueosPTrasera()
    {
        return $this->bloqueosPTrasera;
    }

    /**
     * @param int $bloqueosPTrasera
     * @return GovernmentData
     */
    public function setBloqueosPTrasera($bloqueosPTrasera)
    {
        $this->bloqueosPTrasera = $bloqueosPTrasera;
        return $this;
    }


}
