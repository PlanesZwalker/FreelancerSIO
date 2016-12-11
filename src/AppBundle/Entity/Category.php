<?php

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Category
 */
class Category
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     * 
     */
    private $blogPost;

    /**
     * @var string
     */
    private $category;

    /**
     * @var bool
     */
    private $draft;

    

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    
    /**
     * Set name
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set blogPost
     *
     * @param string $blogPost
     *
     * @return Category
     */
    public function setBlogPost($blogPost)
    {
        $this->blogPost = $blogPost;

        return $this;
    }

    /**
     * Get blogPost
     *
     * @return string
     */
    public function getBlogPost()
    {
        return $this->blogPost;
    }

    /**
     * Set category
     *
     * @param string $category
     *
     * @return Category
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set draft
     *
     * @param boolean $draft
     *
     * @return Category
     */
    public function setDraft($draft)
    {
        $this->draft = $draft;

        return $this;
    }

    /**
     * Get draft
     *
     * @return bool
     */
    public function getDraft()
    {
        return $this->draft;
    }
    
    
    
    public function __construct()
    {
        $this->blogPosts = new ArrayCollection();
    }
    
    
}

