<?php

namespace MyFOSUserBundle\Entity;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Doctrine\ORM\Mapping as ORM;

/**
 * Freelancer
 *
 * @ORM\Table(name="freelancer", indexes={@ORM\Index(name="user", columns={"user"})})
 * @ORM\Entity
 */
class Freelancer
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
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="pseudo", type="string", length=255, nullable=false)
     */
    private $pseudo;

    /**
     * @var string
     *
     * @ORM\Column(name="nationalite", type="string", length=255, nullable=false)
     */
    private $nationalite;

    /**
     * @var integer
     *
     * @ORM\Column(name="age", type="integer", nullable=false)
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="cv", type="string", length=255, nullable=false)
     */
    private $cv;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=false)
     */
    private $photo;

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
     * Set description
     *
     * @param string $description
     *
     * @return Freelancer
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set pseudo
     *
     * @param string $pseudo
     *
     * @return Freelancer
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set nationalite
     *
     * @param string $nationalite
     *
     * @return Freelancer
     */
    public function setnationalite($nationalite)
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    /**
     * Get nationalite
     *
     * @return string
     */
    public function getnationalite()
    {
        return $this->nationalite;
    }

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return Freelancer
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set cv
     *
     * @param string $cv
     *
     * @return Freelancer
     */
    public function setCv(UploadedFile $cv)
    {
        $this->cv = $cv;

        return $this;
    }

    /**
     * Get cv
     *
     * @return string
     */
    public function getCv()
    {
        return $this->cv;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Freelancer
     */
    public function setPhoto(UploadedFile $photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    
    /*
     *  UPLOAD DE LA PHOTO
     * 
     */
    
    public function getUploadPhotoDir(){
        return '/user/photo';
    }
 
    public function getAbsolutePhotoRoot(){ 
            return $this->getUploadPhotoRoot().$this->pseudo;
    }

    public function getWebPhotoPath(){

        return $this->getUploadPhotoDir().'/'.$this->pseudo;
    }

    public function getUploadPhotoRoot(){
         return __DIR__.'/../../../web'. $this->getUploadPhotoDir().'/';
    }   
    
    public function uploadPhoto(){
   

        if($this->photo === null){
            return;
        }
      
        $this->pseudo = $this->getPseudo();
        
        if(!is_dir($this->getWebPhotoPath())){
             mkdir($this->getWebPhotoPath(), '0777',true); 
        }
              
        $this->photo->move($this->getUploadPhotoRoot(), $this->pseudo);
   
        unset($this->photo);
    }
        
    
    /*
     * 
     *      UPLOAD DU CV
     */
    public function getUploadCvDir(){
        return '/user/cv';
    }
  
    public function getAbsoluteCvRoot(){
        return $this->getUploadCvRoot().$this->user->getName();
    }
    
    public function getWebCvPath(){

        return $this->getUploadCvDir().'/'.$this->pseudo;
    }
    
    public function getUploadCvRoot(){
         return __DIR__.'/../../../web'. $this->getUploadCvDir().'/';
    }
 
    public function uploadCv(){
        
        if($this->cv === null){
            return;
        }
        $this->pseudo = $this->getPseudo();
        
        if(!is_dir($this->getWebCvPath())){
            
             mkdir($this->getWebCvPath(), '0777', true);
        }
              
        $this->cv->move($this->getUploadCvRoot(), $this->pseudo);
   
         unset($this->cv);
    }
    
    
    
    /**
     * Set user
     *
     * @param \MyFOSUserBundle\Entity\User $user
     *
     * @return Freelancer
     */
    public function setUser(\MyFOSUserBundle\Entity\User $user )
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
