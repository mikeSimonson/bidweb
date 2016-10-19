<?php

namespace Bidweb\BidwebBundle\Entity;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Job
 *
 * @author HAMMAMI
 */
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Bidweb\BidwebBundle\Repository\JobRepository")
 * @ORM\Table(name="job")
 * @ORM\HasLifecycleCallbacks
 */
class Job {

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
     *
     * @var datetime
     * @ORM\Column(name="expired", type="datetime", nullable=false) 
     */
    private $expired;

    /**
     *
     * @var datetime
     * @ORM\Column(name="modified", type="datetime", nullable=false) 
     */
    private $modified;

    /**
     * @var State
     * 
     * @ORM\ManyToOne(targetEntity="State")
     * @ORM\JoinColumn(name="state_id", referencedColumnName="id")
     */
    protected $state;

    /**
     * @var City
     * 
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */
    protected $city;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="job")
     */
    protected $comments;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=false)
     */
    private $title;

    /**
     * @ORM\Column(name="description", type="string", length=1000, nullable=false)
     *
     * @Assert\NotBlank(message="Please enter your description")
     * @Assert\Length(
     *     min=5,
     *     max="1000",
     *     minMessage="The description is too short.",
     *     maxMessage="The description is too long.",
     * )
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="budget", type="float", nullable=true)
     */
    private $budget;
    
    /**
     * @var string
     *
     * @ORM\Column(name="company_name", type="string", length=100, nullable=false)
     */
    private $companyName;

    /**
     * @var string
     *
     * @ORM\Column(name="skills", type="string", length=1000, nullable=false)
     */
    private $skills;

    /**
     * @var Duration
     * 
     * @ORM\ManyToOne(targetEntity="Duration")
     * @ORM\JoinColumn(name="duration_id", referencedColumnName="id")
     */
    protected $duration;

    /**
     * @var WorkingType
     * 
     * @ORM\ManyToOne(targetEntity="WorkingType")
     * @ORM\JoinColumn(name="working_type_id", referencedColumnName="id")
     */
    protected $workingType;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=false)
     */
    private $address;

    /**
     * @var string
     * 
     * @ORM\Column(type="string")
     */
    protected $slug;

     /**
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

    /**
     * @ORM\ManyToOne(targetEntity="SubCategory")
     * @ORM\JoinColumn(name="subcategory_id", referencedColumnName="id")
     */
    protected $subcategory;
    
    
    /**
     * @var \Bidweb\UserBundle\Entity\User
     * 
     * @ORM\ManyToOne(targetEntity="\Bidweb\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
    
    /**
     *
     * @var string
     * @ORM\Column(name="logo", type="string", length=255, nullable=true) 
     */
    private $logo;
    
    /**
     * @Assert\File(maxSize="6000000")
     */
    public $file;
    
    
    
    public function __toString(){
        return $this->title;
    }
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->created = new \DateTime();
        $this->expired = new \DateTime();
        $this->modified = new \DateTime();
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
     * Set created
     *
     * @param \DateTime $created
     * @return Job
     */
    public function setCreated($created) {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated() {
        return $this->created;
    }

    /**
     * Set expired
     *
     * @param \DateTime $expired
     * @return Job
     */
    public function setExpired($expired) {
        $this->expired = $expired;

        return $this;
    }

    /**
     * Get expired
     *
     * @return \DateTime 
     */
    public function getExpired() {
        return $this->expired;
    }

    /**
     * Set modified
     *
     * @param \DateTime $modified
     * @return Job
     */
    public function setModified($modified) {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime 
     */
    public function getModified() {
        return $this->modified;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Job
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Job
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription($length=null) {
        
        if (false === is_null($length) && $length > 0)
            return substr($this->description, 0, $length);
        else
            return $this->description;
        
    }

    /**
     * Set companyName
     *
     * @param string $companyName
     * @return Job
     */
    public function setCompanyName($companyName) {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get companyName
     *
     * @return string 
     */
    public function getCompanyName() {
        return $this->companyName;
    }

    /**
     * Set skills
     *
     * @param string $skills
     * @return Job
     */
    public function setSkills($skills) {
        $this->skills = $skills;

        return $this;
    }

    /**
     * Get skills
     *
     * @return string 
     */
    public function getSkills() {
        return $this->skills;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Job
     */
    public function setAddress($address) {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * Set state
     *
     * @param \Bidweb\BidwebBundle\Entity\State $state
     * @return Job
     */
    public function setState(\Bidweb\BidwebBundle\Entity\State $state = null) {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return \Bidweb\BidwebBundle\Entity\State 
     */
    public function getState() {
        return $this->state;
    }

    /**
     * Set city
     *
     * @param \Bidweb\BidwebBundle\Entity\City $city
     * @return Job
     */
    public function setCity(\Bidweb\BidwebBundle\Entity\City $city = null) {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \Bidweb\BidwebBundle\Entity\City 
     */
    public function getCity() {
        return $this->city;
    }

    /**
     * Add comments
     *
     * @param \Bidweb\BidwebBundle\Entity\Comment $comments
     * @return Job
     */
    public function addComment(\Bidweb\BidwebBundle\Entity\Comment $comments) {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \Bidweb\BidwebBundle\Entity\Comment $comments
     */
    public function removeComment(\Bidweb\BidwebBundle\Entity\Comment $comments) {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments() {
        return $this->comments;
    }

    /**
     * Set duration
     *
     * @param \Bidweb\BidwebBundle\Entity\Duration $duration
     * @return Job
     */
    public function setDuration(\Bidweb\BidwebBundle\Entity\Duration $duration = null) {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return \Bidweb\BidwebBundle\Entity\Duration 
     */
    public function getDuration() {
        return $this->duration;
    }

    /**
     * Set workingType
     *
     * @param \Bidweb\BidwebBundle\Entity\WorkingType $workingType
     * @return Job
     */
    public function setWorkingType(\Bidweb\BidwebBundle\Entity\WorkingType $workingType = null) {
        $this->workingType = $workingType;

        return $this;
    }

    /**
     * Get workingType
     *
     * @return \Bidweb\BidwebBundle\Entity\WorkingType 
     */
    public function getWorkingType() {
        return $this->workingType;
    }

    function slugUrl($str, $spaceRepl = "_") {
        // Make sure string is in UTF-8 and strip invalid UTF-8 characters
        $str = mb_convert_encoding((string) $str, 'UTF-8', mb_list_encodings());
        $options = array('delimiter' => '_');
        $defaults = array(
            'delimiter' => '-',
            'limit' => null,
            'lowercase' => true,
            'replacements' => array(),
            'transliterate' => false,
        );

        // Merge options
        $options = array_merge($defaults, $options);

        $char_map = array(
            // Latin
            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
            'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
            'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
            'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
            'ß' => 'ss',
            'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
            'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
            'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
            'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
            'ÿ' => 'y',
            // Latin symbols
            '©' => '(c)',
            // Greek
            'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
            'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
            'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
            'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
            'Ϋ' => 'Y',
            'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
            'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
            'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
            'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
            'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
            // Turkish
            'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
            'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',
            // Russian
            'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
            'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
            'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
            'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
            'Я' => 'Ya',
            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
            'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
            'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
            'я' => 'ya',
            // Ukrainian
            'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
            'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
            // Czech
            'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
            'Ž' => 'Z',
            'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
            'ž' => 'z',
            // Polish
            'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
            'Ż' => 'Z',
            'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
            'ż' => 'z',
            // Latvian
            'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
            'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
            'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
            'š' => 's', 'ū' => 'u', 'ž' => 'z'
        );

        // Make custom replacements
        $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);

        // Transliterate characters to ASCII
        if ($options['transliterate']) {
            $str = str_replace(array_keys($char_map), $char_map, $str);
        }

        // Replace non-alphanumeric characters with our delimiter
        $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);

        // Remove duplicate delimiters
        $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);

        // Truncate slug to max. characters
        $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');

        // Remove delimiter from ends
        $str = trim($str, $options['delimiter']);

        return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
    }


    /**
     * Set slug
     *
     * @param string $slug
     * @return Job
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set category
     *
     * @param \Bidweb\BidwebBundle\Entity\Category $category
     * @return Job
     */
    public function setCategory(\Bidweb\BidwebBundle\Entity\Category $category = null)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return \Bidweb\BidwebBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set subcategory
     *
     * @param \Bidweb\BidwebBundle\Entity\SubCategory $subcategory
     * @return Job
     */
    public function setSubcategory(\Bidweb\BidwebBundle\Entity\SubCategory $subcategory = null)
    {
        $this->subcategory = $subcategory;
    
        return $this;
    }

    /**
     * Get subcategory
     *
     * @return \Bidweb\BidwebBundle\Entity\SubCategory 
     */
    public function getSubcategory()
    {
        return $this->subcategory;
    }

    /**
     * Set user
     *
     * @param \Bidweb\UserBundle\Entity\User $user
     * @return Job
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
    
    public function getAbsoluteImage()
    {
        
        return null === $this->logo ? null : $this->getUploadRootDir().'/'.$this->logo;
        
    }

    public function getWebPath()
    {
        
        return null === $this->logo ? null : $this->getUploadDir().'/'.$this->logo;
        
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'uploads/images';
    }
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        // la propriété « file » peut être vide si le champ n'est pas requis
        if (null === $this->file) {
            return;
        }
        
        if($this->file !== null){
            $this->file->move($this->getUploadRootDir(),  $this->logo);
            
            unset($this->file);
        }
    }
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->file) {
            // faites ce que vous voulez pour générer un nom unique
            $this->logo = sha1(uniqid(mt_rand(), true)).'.'.$this->file->guessExtension();
        }
    }
    
    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($this->file = $this->getAbsoluteImage()) {
            unlink($this->file);
        }
    }

    /**
     * Set logo
     *
     * @param string $logo
     * @return Job
     */
    public function setLogo($logo)
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

    /**
     * Set budget
     *
     * @param float $budget
     *
     * @return Job
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * Get budget
     *
     * @return float
     */
    public function getBudget()
    {
        return $this->budget;
    }
}
