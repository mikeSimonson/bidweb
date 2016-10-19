<?php

namespace Bidweb\BidwebBundle\Entity;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Comment
 *
 * @author HAMMAMI
 */
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="Bidweb\BidwebBundle\Repository\CommentRepository")
 * @ORM\Table(name="comment")
 */
class Comment {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(name="message", type="string", length=1000, nullable=false)
     * @Assert\NotBlank(message="Please enter your message.")
     * @Assert\Length(
     *     min=10,
     *     max="1000",
     *     minMessage="The message is too short.",
     *     maxMessage="The message is too long.",
     * )
     */
    private $message;

    /**
     * @var \Bidweb\BidwebBundle\Entity\User
     * 
     * @ORM\ManyToOne(targetEntity="\Bidweb\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
    
    /**
     * @var Post
     * 
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="comments")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     */
    protected $post;
    
    /**
     * @var Job
     * 
     * @ORM\ManyToOne(targetEntity="Job", inversedBy="comments")
     * @ORM\JoinColumn(name="job_id", referencedColumnName="id")
     */
    protected $job;


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
     * Set created
     *
     * @param \DateTime $created
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
     * Set message
     *
     * @param string $message
     * @return Comment
     */
    public function setMessage($message)
    {
        $this->message = $message;
    
        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set user
     *
     * @param \Bidweb\UserBundle\Entity\User $user
     * @return Comment
     */
    public function setUser(\Bidweb\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Bidweb\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set post
     *
     * @param \Bidweb\BidwebBundle\Entity\Post $post
     * @return Comment
     */
    public function setPost(\Bidweb\BidwebBundle\Entity\Post $post = null)
    {
        $this->post = $post;
    
        return $this;
    }

    /**
     * Get post
     *
     * @return \Bidweb\BidwebBundle\Entity\Post 
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set job
     *
     * @param \Bidweb\BidwebBundle\Entity\Job $job
     * @return Comment
     */
    public function setJob(\Bidweb\BidwebBundle\Entity\Job $job = null)
    {
        $this->job = $job;
    
        return $this;
    }

    /**
     * Get job
     *
     * @return \Bidweb\BidwebBundle\Entity\Job 
     */
    public function getJob()
    {
        return $this->job;
    }
    
    public function __construct()
    {
        
        $this->setCreated(new \DateTime());
       
    }

}
