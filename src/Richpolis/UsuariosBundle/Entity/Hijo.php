<?php

namespace Richpolis\UsuariosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Hijo
 *
 * @ORM\Table(name="hijos")
 * @ORM\Entity(repositoryClass="Richpolis\UsuariosBundle\Entity\HijoRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Hijo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apodo", type="string", length=255,nullable=true)
     */
    private $apodo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="usarApodo", type="boolean")
     */
    private $usarApodo;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="sexo", type="integer")
     */
    private $sexo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaNacimiento", type="date")
     */
    private $fechaNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="biografia", type="text",nullable=true)
     */
    private $biografia;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=255, nullable=true)
     */
    private $imagen;

    /**
     * @var \Richpolis\UsuariosBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Richpolis\UsuariosBundle\Entity\Usuario", inversedBy="hijos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="papa_id", referencedColumnName="id")
     * })
     */
    private $papa;
    
   
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;
    
    
    const INDEFINIDO = 0;
    const NINO = 1;
    const NINA = 2;
    
    static public $sSexo=array(
        self::INDEFINIDO=>'',
        self::NINO=>'Niño',
        self::NINA=>'Niña',
    );
    
    public function __construct() {
        $this->sexo= self::INDEFINIDO;
        $this->usarApodo = true;
    }
    
    public function getStringSexo(){
        return self::$sSexo[$this->getSexo()];
    }

    static function getArraySexo(){
        return self::$sSexo;
    }

    static function getPreferedSexo(){
        return array(self::INDEFINIDO);
    }

    public function __toString() {
        if($this->usarApodo){
            return $this->getApodo();
        }else{
            return $this->getNombre();
        }
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Hijo
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apodo
     *
     * @param string $apodo
     * @return Hijo
     */
    public function setApodo($apodo)
    {
        $this->apodo = $apodo;

        return $this;
    }

    /**
     * Get apodo
     *
     * @return string 
     */
    public function getApodo()
    {
        return $this->apodo;
    }

    /**
     * Set usarApodo
     *
     * @param boolean $usarApodo
     * @return Hijo
     */
    public function setUsarApodo($usarApodo)
    {
        $this->usarApodo = $usarApodo;

        return $this;
    }

    /**
     * Get usarApodo
     *
     * @return boolean 
     */
    public function getUsarApodo()
    {
        return $this->usarApodo;
    }
    
    /**
     * @Assert\True(message = "Ingresar el apodo.")
     */
    public function isUsarApodoValid()
    {
        if($this->getUsarApodo()){
            return strlen(trim($this->getApodo()))>0;
        }
        return true;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     * @return Hijo
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime 
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set biografia
     *
     * @param string $biografia
     * @return Hijo
     */
    public function setBiografia($biografia)
    {
        $this->biografia = $biografia;

        return $this;
    }

    /**
     * Get biografia
     *
     * @return string 
     */
    public function getBiografia()
    {
        return $this->biografia;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     * @return Hijo
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string 
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set papa
     *
     * @param \Richpolis\UsuariosBundle\Entity\Usuario $papa
     * @return Hijo
     */
    public function setPapa(\Richpolis\UsuariosBundle\Entity\Usuario $papa = null)
    {
        $this->papa = $papa;

        return $this;
    }

    /**
     * Get papa
     *
     * @return \Richpolis\UsuariosBundle\Entity\Usuario 
     */
    public function getPapa()
    {
        return $this->papa;
    }
    
    /*
     * Timestable
     */
    
    /**
     ** @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        if(!$this->getCreatedAt())
        {
          $this->createdAt = new \DateTime();
        }
        if(!$this->getUpdatedAt())
        {
          $this->updatedAt = new \DateTime();
        }
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        $this->updatedAt = new \DateTime();
    }
    
    /*** uploads ***/
    
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->imagen)) {
            // store the old name to delete after the update
            $this->temp = $this->imagen;
            $this->imagen = null;
        } else {
            $this->imagen = 'initial';
        }
        $directorio=$this->getUploadRootDir();
        if(!file_exists($directorio)){
          mkdir($directorio, 0777);  
        }
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }
    
    /**
    * @ORM\PrePersist
    * @ORM\PreUpdate
    */
    public function preUpload()
    {
      if (null !== $this->getFile()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->imagen = $filename.'.'.$this->getFile()->guessExtension();
        }
    }

    /**
    * @ORM\PostPersist
    * @ORM\PostUpdate
    */
    public function upload()
    {
      if (null === $this->getFile()) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFile()->move($this->getUploadRootDir(), $this->imagen);

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->getUploadRootDir().'/'.$this->temp);
            // clear the temp image path
            $this->temp = null;
        }
        $this->file = null;
    }

    /**
    * @ORM\PostRemove
    */
    public function removeUpload()
    {
      if ($file = $this->getAbsolutePath()) {
        if(file_exists($file)){
            unlink($file);
        }
      }
    }
    
    protected function getUploadDir()
    {
        return '/uploads/hijos';
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../web'.$this->getUploadDir();
    }
    
    
    /**
     * Rutas de archivos 
     */
    public function getWebPath()
    {
        return null === $this->imagen ? null : $this->getUploadDir().'/'.$this->imagen;
    }
    
    public function getAbsolutePath()
    {
        return null === $this->imagen ? null : $this->getUploadRootDir().'/'.$this->imagen;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Hijo
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Hijo
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set sexo
     *
     * @param integer $sexo
     * @return Hijo
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return integer 
     */
    public function getSexo()
    {
        return $this->sexo;
    }
}
