<?php

namespace MyFOSUserBundle\Entity;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Doctrine\ORM\Mapping as ORM;

/**
 * Societe
 *
 * @ORM\Table(name="societe", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_19653DBD8D93D649", columns={"user"})})
 * @ORM\Entity
 */
class Societe
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="denomination", type="string", length=255, nullable=false)
     */
    private $denomination;

    /**
     * @var string
     *
     * @ORM\Column(name="presentation", type="string", length=255, nullable=false)
     */
    private $presentation;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=false)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="siret", type="string", length=255, nullable=false)
     */
    private $siret;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=255, nullable=false)
     */
    private $tel;


    private $logo;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id")
     * })
     */
    private $user;



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
     * Set denomination
     *
     * @param string $denomination
     *
     * @return Societe
     */
    public function setDenomination($denomination)
    {
        $this->denomination = $denomination;

        return $this;
    }

    /**
     * Get denomination
     *
     * @return string
     */
    public function getDenomination()
    {
        return $this->denomination;
    }

    /**
     * Set presentation
     *
     * @param string $presentation
     *
     * @return Societe
     */
    public function setPresentation($presentation)
    {
        $this->presentation = $presentation;

        return $this;
    }

    /**
     * Get presentation
     *
     * @return string
     */
    public function getPresentation()
    {
        return $this->presentation;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Societe
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set siret
     *
     * @param string $siret
     *
     * @return Societe
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;

        return $this;
    }

    /**
     * Get siret
     *
     * @return string
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * Set tel
     *
     * @param string $tel
     *
     * @return Societe
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return Societe
     */
    public function setLogo(UploadedFile $logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }
    
    
    /*
     *  UPLOAD DU LOGO
     * 
     */
    
    public function getUploadLogoDir(){
        return '/user/logo';
    }
 
    public function getAbsoluteLogoRoot(){
        return $this->getUploadLogoRoot().$this->getUser()->getId();
    }

    public function getWebLogoPath(){
        return $this->getUploadLogoDir().'/'.$this->getUser()->getId();
    }

    public function getUploadLogoRoot(){
         return __DIR__.'/../../../web'. $this->getUploadLogoDir().'/';
    }   
    
    public function uploadLogo(){

        
        if(!is_dir($this->getWebLogoPath())){
   
             mkdir($this->getWebLogoPath(), '0777',true);
              
        }
              
        $this->logo->move($this->getUploadLogoRoot(), $this->getUser()->getId());
   
        unset($this->logo);
    }
        

    /**
     * Set user
     *
     * @param \MyFOSUserBundle\Entity\User $user
     *
     * @return Societe
     */
    public function setUser(\MyFOSUserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \MyFOSUserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
