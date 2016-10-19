<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Bidweb\BidwebBundle\Entity;
/**
 * Description of Profile
 *
 * @author HAMMAMI
 */

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Bidweb\UserBundle\Entity\User;
/**
 * @ORM\Entity(repositoryClass="Bidweb\BidwebBundle\Repository\ProfileRepository")
 * @ORM\Table(name="profile")
 * @ORM\HasLifecycleCallbacks
 */
class Profile {
     /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var \Bidweb\BidwebBundle\Entity\User
     * 
     * @ORM\OneToOne(targetEntity="\Bidweb\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    
    
     /**
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     *
     * @Assert\NotBlank(message="Please enter your title (ex : PHP developper).")
     * @Assert\Length(
     *     min=3,
     *     max="255",
     *     minMessage="The Title is too short.",
     *     maxMessage="The Title is too long.",
     * )
     */
    private $title;
    
    
    /**
     *  @ORM\Column(name="diploma",type="string",length=255, nullable=true)
     */
    private $diploma;
    
    /**
     *  @ORM\Column(name="diploma2",type="string",length=255, nullable=true)
     */
    private $diploma2;
    
    /**
     *  @ORM\Column(name="diploma3",type="string",length=255, nullable=true)
     */
    private $diploma3;
    
    /**
     *  @ORM\Column(name="certif",type="string",length=255, nullable=true)
     */
    private $certification;
    
    /**
     *  @ORM\Column(name="certif2",type="string",length=255, nullable=true)
     */
    private $certification2;
    
    /**
     *  @ORM\Column(name="certif3",type="string",length=255, nullable=true)
     */
    private $certification3;
    
    /**
     *
     * @var string
     * @ORM\Column(name="image", type="string", length=255, nullable=true) 
     */
    private $image;
    
    /**
     *
     * @var string
     * @ORM\Column(name="cv", type="string", length=255, nullable=true) 
     */
    private $cv;
    
    /**
     *
     * @var string
     * @ORM\Column(name="resume", type="string", length=255, nullable=true) 
     */
    private $resume;
    
    
    /**
     * @ORM\Column(name="description", type="string", length=1000, nullable=false)
     *
     * @Assert\NotBlank(message="Please enter your description (see example <a href='www.google.com'>Example 1</a>).")
     * @Assert\Length(
     *     min=5,
     *     max="1000",
     *     minMessage="The description is too short.",
     *     maxMessage="The description is too long.",
     * )
     */
    private $description;
    
    
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
     *
     * @var datetime
     * @ORM\Column(name="created", type="datetime", nullable=false) 
     */
    private $created;
    
    /**
     *
     * @var datetime
     * @ORM\Column(name="updated", type="datetime", nullable=false) 
     */
    private $updated;
    /**
     *
     * @var boolean
     * @ORM\Column(name="publish", type="boolean", nullable=false) 
     */
    private $publish;
    
    /**
     * @var string
     * 
     * @ORM\Column(type="string")
     */
    protected $slug;
    
    public function __construct(User $user) {
        $this->user = $user;
        $this->created = new \DateTime();
        $this->updated = new \DateTime();
        $this->publish = true;
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
     * Set title
     *
     * @param string $title
     * @return Profile
     */
    public function setTitle($title)
    {
        $this->title = $title;
        
        return $this;
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
     * Set image
     *
     * @param string $image
     * @return Profile
     */
    public function setImage($image)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set cv
     *
     * @param string $cv
     * @return Profile
     */
    public function setCv($cv)
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
     * Set resume
     *
     * @param string $resume
     * @return Profile
     */
    public function setResume($resume)
    {
        $this->resume = $resume;
    
        return $this;
    }

    /**
     * Get resume
     *
     * @return string 
     */
    public function getResume($length=null)
    {
        if (false === is_null($length) && $length > 0)
            return substr($this->resume, 0, $length);
        else
            return $this->resume;
        
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Profile
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
    public function getDescription($length=null)
    {
        if (false === is_null($length) && $length > 0)
            return substr($this->description, 0, $length);
        else
            return $this->description;
    }

    /**
     * Set user
     *
     * @param \Bidweb\UserBundle\Entity\User $user
     * @return Profile
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
     * Set diploma
     *
     * @param string $diploma
     * @return Profile
     */
    public function setDiploma($diploma)
    {
        $this->diploma = $diploma;
    
        return $this;
    }

    /**
     * Get diploma
     *
     * @return string 
     */
    public function getDiploma()
    {
        return $this->diploma;
    }

    /**
     * Set diploma2
     *
     * @param string $diploma2
     * @return Profile
     */
    public function setDiploma2($diploma2)
    {
        $this->diploma2 = $diploma2;
    
        return $this;
    }

    /**
     * Get diploma2
     *
     * @return string 
     */
    public function getDiploma2()
    {
        return $this->diploma2;
    }

    /**
     * Set diploma3
     *
     * @param string $diploma3
     * @return Profile
     */
    public function setDiploma3($diploma3)
    {
        $this->diploma3 = $diploma3;
    
        return $this;
    }

    /**
     * Get diploma3
     *
     * @return string 
     */
    public function getDiploma3()
    {
        return $this->diploma3;
    }

    /**
     * Set certification
     *
     * @param string $certification
     * @return Profile
     */
    public function setCertification($certification)
    {
        $this->certification = $certification;
    
        return $this;
    }

    /**
     * Get certification
     *
     * @return string 
     */
    public function getCertification()
    {
        return $this->certification;
    }

    /**
     * Set certification2
     *
     * @param string $certification2
     * @return Profile
     */
    public function setCertification2($certification2)
    {
        $this->certification2 = $certification2;
    
        return $this;
    }

    /**
     * Get certification2
     *
     * @return string 
     */
    public function getCertification2()
    {
        return $this->certification2;
    }

    /**
     * Set certification3
     *
     * @param string $certification3
     * @return Profile
     */
    public function setCertification3($certification3)
    {
        $this->certification3 = $certification3;
    
        return $this;
    }

    /**
     * Get certification3
     *
     * @return string 
     */
    public function getCertification3()
    {
        return $this->certification3;
    }
    
    public function getAbsoluteImage()
    {
       
        return null === $this->image ? null : $this->getUploadRootDir().'/'.$this->image;
       
    }

    public function getWebPathImage()
    {
        return null === $this->image ? null : $this->getUploadDir().'/'.$this->image;
        
    }
    
    public function getAbsoluteCv()
    {
       
        return null === $this->cv ? null : $this->getUploadRootDir().'/'.$this->cv;
       
    }

    public function getWebPathCv()
    {
        return null === $this->cv ? null : $this->getUploadDir().'/'.$this->cv;
        
    }
    
     public function getAbsoluteResume()
    {
       
        return null === $this->resume ? null : $this->getUploadRootDir().'/'.$this->resume;
       
    }

    public function getWebPathResume()
    {
        return null === $this->resume ? null : $this->getUploadDir().'/'.$this->resume;
        
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
        
        return 'uploads/users/user_'.$this->getUser()->getId();
    }
    
    /**
     * @Assert\File(maxSize="6000000",
     * mimeTypes = {
     *          "application/msword",
     *          "application/pdf",
     *          "application/x-pdf",
     *          "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
     *      },
     * mimeTypesMessage="Invalid type file(must be .doc, .docx, .pdf)"
     * )
     */
    public $fileCv;

    /**
     * @Assert\File(maxSize="6000000",
     * mimeTypes = {
     *         "application/msword",
     *          "application/pdf",
     *          "application/x-pdf",
     *          "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
     *      },
     * mimeTypesMessage="Invalid type file(must be .doc, .docx, .pdf)"
     * )
     */
    public $fileResume;
    
    /**
     * @Assert\File(maxSize="6000000",
     * mimeTypes = {
     *          "image/png",
     *          "image/jpeg",
     *          "image/jpg",
     *          "image/gif",
     *          "application/pdf",
     *          "application/x-pdf"
     *      },
     * mimeTypesMessage="Invalid type file(must be image or pdf file)"
     * )
     */
    public $fileImage;
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
//        if (null !== $this->fileCv) {
//            // faites ce que vous voulez pour générer un nom unique
//            $this->cv = sha1(uniqid(mt_rand(), true)).'.'.$this->fileCv->guessExtension();
//        }
        
//        if (null !== $this->fileResume) {
//            // faites ce que vous voulez pour générer un nom unique
//            $this->resume = sha1(uniqid(mt_rand(), true)).'.'.$this->fileResume->guessExtension();
//        }
      
        if (null !== $this->fileImage) {
            
            // faites ce que vous voulez pour générer un nom unique
            $this->image = sha1(uniqid(mt_rand(), true)).'.'.$this->fileImage->guessExtension();
        }
    }
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        // la propriété « file » peut être vide si le champ n'est pas requis
        
        
//        if($this->fileCv !== null){
//            $this->fileCv->move($this->getUploadRootDir(),  $this->cv);
//            
//            unset($this->fileCv);
//        }
        
        if($this->fileImage !== null){
            $this->fileImage->move($this->getUploadRootDir(),  $this->image);
            
            unset($this->fileImage);
        }
        
//        if($this->fileResume !== null){
//            $this->fileResume->move($this->getUploadRootDir(),  $this->resume);
//            
//            unset($this->fileResume);
//        }
    }
    
    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
//        if ($this->fileCv = $this->getAbsoluteCv()) {
//            unlink($this->fileCv);
//        }
//        
        if ($this->fileImage = $this->getAbsoluteImage()) {
            unlink($this->fileImage);
        }
        
//        if ($this->fileResume = $this->getAbsoluteResume()) {
//            unlink($this->fileResume);
//        }
        
    }
    

    /**
     * Set category
     *
     * @param \Bidweb\BidwebBundle\Entity\Category $category
     * @return Profile
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
     * @return Profile
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
     * Set created
     *
     * @param \DateTime $created
     * @return Profile
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
     * Set publish
     *
     * @param boolean $publish
     * @return Profile
     */
    public function setPublish($publish)
    {
        $this->publish = $publish;
    
        return $this;
    }

    /**
     * Get publish
     *
     * @return boolean 
     */
    public function getPublish()
    {
        return $this->publish;
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
     * @return Profile
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
    
    public function __toString() {
        return $this->title;
    }
    
    

    public function getWebPath()
    {
        
        return null === $this->image ? null : $this->getUploadDir().'/'.$this->image;
        
    }

   
    

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Profile
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
    
    
}
