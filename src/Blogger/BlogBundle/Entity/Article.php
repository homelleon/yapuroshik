<?php

namespace Blogger\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Blogger\FileBundle\Entity\Image;

/**
 * News blog entity.
 * 
 * @ORM\Entity
 * @ORM\Table(name="article") 
 * 
 */
class Article {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $theme;
    
    /**
     * @ORM\OneToOne(targetEntity="Blogger\FileBundle\Entity\Image")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */ 
    private $image;

    /**
     * @ORM\Column(type="text")
     */
    private $description;
    
    /**
     * @ORM\ManyToMany(targetEntity="Comment")
     * @ORM\JoinTable(name="comments_id", 
     *  joinColumns={@ORM\JoinColumn(name="article_id", referencedColumnName="id")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="comment_id", 
     *  referencedColumnName="id", unique=true)})
     * @var type 
     */
    private $comments;
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $created;
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $updated;
    
    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $is_deleted;
    
     /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $is_updated;
    
    public function __construct() {
        $this->is_deleted = false;
        $this->is_updated = false;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }
    
        /**
     * Set title
     *
     * @param string $title
     *
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set author
     *
     * @param string $author
     * 
     */
    public function setAuthor($author) {
        $this->author = $author;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor() {
        return $this->author;
    }

    /**
     * Set theme
     *
     * @param string $theme
     *
     */
    public function setTheme($theme) {
        $this->theme = $theme;
    }

    /**
     * Get theme
     *
     * @return string
     */
    public function getTheme() {
        return $this->theme;
    }

    /**
     * Set image
     *
     * @param integer $image
     * 
     */
    public function setImage($image) {
        $this->image = $image;
    }

    /**
     * Get image
     *
     * @return integer
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    public function getComments() {
        return $this->comments;
    }
    
    public function addComment(\Blogger\BlogBundle\Entity\Comment $comment) {
        $this->comments[] = $comment;
    }    
    
    /**
     * Remove comment
     *
     * @param \Blogger\BlogBundle\Entity\Comment $comment
     */
    public function removeComment(\Blogger\BlogBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }


    /**
     * Set isDeleted
     *
     * @param boolean $isDeleted
     *
     * @return Article
     */
    public function setIsDeleted($isDeleted)
    {
        $this->is_deleted = $isDeleted;

        return $this;
    }

    /**
     * Get isDeleted
     *
     * @return boolean
     */
    public function getIsDeleted()
    {
        return $this->is_deleted;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Article
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set isUpdated
     *
     * @param boolean $isUpdated
     *
     * @return Article
     */
    public function setIsUpdated($isUpdated)
    {
        $this->is_updated = $isUpdated;

        return $this;
    }

    /**
     * Get isUpdated
     *
     * @return boolean
     */
    public function getIsUpdated()
    {
        return $this->is_updated;
    }

}
