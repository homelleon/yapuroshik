<?php

namespace AppBundle\Entity\Blog;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Description of Comment
 * @ORM\Entity
 * @ORM\Table(name="comment") 
 * @author homelleon
 */
class Comment {
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Blogger\BlogBundle\Entity\User\User")
     */ 
    private $author;
    
    /**
     * @ORM\Column(type="text")
     */
    private $content;
    
    /**
     * @ORM\ManyToMany(targetEntity="Blogger\BlogBundle\Entity\User\User")
     * @ORM\JoinTable(name="users_id", 
     *  joinColumns={@ORM\JoinColumn(name="comment_id", referencedColumnName="id")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="user_id", 
     *  referencedColumnName="id",unique=false)})
     */ 
    private $liked;
    
    /**
     * @ORM\Column(type="datetime")   
     */
    private $created;
    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated;
    
     /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $is_deleted;
    
    public function __construct() {
        $this->liked = new ArrayCollection();
        $this->is_deleted = false;
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
     * Set content
     *
     * @param string $content
     *
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Comment
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
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
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Comment
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
     * Set isDeleted
     *
     * @param boolean $isDeleted
     *
     * @return Comment
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
     * Set author
     *
     * @param Blogger\BlogBundle\Entity\User\User $author
     *
     * @return Comment
     */
    public function setAuthor(Blogger\BlogBundle\Entity\User\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return Blogger\BlogBundle\Entity\User\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Add liked
     *
     * @param Blogger\BlogBundle\Entity\User\User $liked
     *
     * @return Comment
     */
    public function addLiked(Blogger\BlogBundle\Entity\User\User $liked)
    {
        $this->liked[] = $liked;

        return $this;
    }

    /**
     * Remove liked
     *
     * @param Blogger\BlogBundle\Entity\User\User $liked
     */
    public function removeLiked(Blogger\BlogBundle\Entity\User\User $liked)
    {
        $this->liked->removeElement($liked);
    }

    /**
     * Get liked
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLiked()
    {
        return $this->liked;
    }
}
