<?php

namespace MyFOSUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Freelancer
 *
 * @ORM\Table(name="freelancer", indexes={@ORM\Index(name="user", columns={"user"})})
 * @ORM\Entity
 */
class Freelancer {

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
    private $cv;
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

    function getId() {
        return $this->id;
    }

    function getDescription() {
        return $this->description;
    }

    function getPseudo() {
        return $this->pseudo;
    }

    function getNationalite() {
        return $this->nationalite;
    }

    function getAge() {
        return $this->age;
    }

    function getUser() {
        return $this->user;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setPseudo($pseudo) {
        $this->pseudo = $pseudo;
    }

    function setNationalite($nationalite) {
        $this->nationalite = $nationalite;
    }

    function setAge($age) {
        $this->age = $age;
    }

    function setUser($user) {
        $this->user = $user;
    }

    /*
     *  UPLOAD DE LA PHOTO
     * 
     */

    public function getUploadPhotoDir() {
        return '/user/photo';
    }

    public function getAbsolutePhotoRoot() {
        return $this->getUploadPhotoRoot() . $this->getUser()->getId();
    }

    public function getWebPhotoPath() {

        return $this->getUploadPhotoDir() . '/' . $this->getUser()->getId();
    }

    public function getUploadPhotoRoot() {
        return __DIR__ . '/../../../web' . $this->getUploadPhotoDir() . '/';
    }

    public function uploadPhoto() {


        if (!is_dir($this->getWebPhotoPath())) {

            mkdir($this->getWebPhotoPath(), '0777', true);
        }

        $this->photo->move($this->getUploadPhotoRoot(), $this->getUser()->getId());

        unset($this->photo);
    }

    /*
     * 
     *      UPLOAD DU CV
     */

    public function getUploadCvDir() {
        return '/user/cv';
    }

    public function getAbsoluteCvRoot() {
        return $this->getUploadCvRoot() . $this->getUser()->getId();
    }

    public function getWebCvPath() {

        return $this->getUploadCvDir() . '/' . $this->getUser()->getId();
    }

    public function getUploadCvRoot() {
        return __DIR__ . '/../../../web' . $this->getUploadCvDir() . '/';
    }

    public function uploadCv() {

/*
        if (!is_dir($this->getWebCvPath())) {

            mkdir($this->getWebCvPath(), '0777', true);
        }
*/
        $this->cv->move($this->getUploadCvRoot(), $this->getUser()->getId());

        unset($this->cv);
    }

    function getCv() {
        return $this->cv;
    }

    function getPhoto() {
        return $this->photo;
    }

    function setCv($cv) {
        $this->cv = $cv;
    }

    function setPhoto($photo) {
        $this->photo = $photo;
    }

}
