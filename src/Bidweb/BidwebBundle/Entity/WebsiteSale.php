<?php

namespace Bidweb\BidwebBundle\Entity;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WebsiteSale
 *
 * @author HAMMAMI
 */

use Doctrine\ORM\Mapping as ORM; // this doctrine lib
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Category
 * @ORM\Entity(repositoryClass="Bidweb\BidwebBundle\Repository\WebsiteRepository")
 * @ORM\Table(name="website_sale")
 * @ORM\HasLifecycleCallbacks
 */

class WebsiteSale {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var \Bidweb\BidwebBundle\Entity\User
     * 
     * @ORM\ManyToOne(targetEntity="\Bidweb\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
    
     /**
     * @ORM\Column(name="site_name", type="string", length=255, nullable=false)
     *
     * @Assert\NotBlank(message="Please enter your title (ex : PHP developper).")
     * @Assert\Length(
     *     min=3,
     *     max="255",
     *     minMessage="The Title is too short.",
     *     maxMessage="The Title is too long.",
     * )
     */
    private $siteName;
    
    
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
     *
     * @var string
     * @ORM\Column(name="domain", type="string", length=1000, nullable=true) 
     */
    private $domain;
    
    /**
     *
     * @var string
     * @ORM\Column(name="logo", type="string", length=255, nullable=true) 
     */
    private $logo;
    
    /**
     *
     * @var string
     * @ORM\Column(name="site_thumbnail", type="string", length=255, nullable=true) 
     */
    private $siteThumbnail;
    
    /**
     * @ORM\Column(name="detail", type="string", length=1000, nullable=false)
     *
     * @Assert\NotBlank(message="Please enter your description.")
     * @Assert\Length(
     *     min=5,
     *     max="1000",
     *     minMessage="The description is too short.",
     *     maxMessage="The description is too long.",
     * )
     */
    private $detail;
    
    /**
     * @var string
     *
     * @ORM\Column(name="price", type="string", length=30, nullable=true)
     */
    private $price;
    
    /**
     * @var ServerType
     * 
     * @ORM\ManyToOne(targetEntity="ServerType")
     * @ORM\JoinColumn(name="server_type_id", referencedColumnName="id")
     */
    protected $serverType;
    
    /**
     * @var BuildType
     * 
     * @ORM\ManyToOne(targetEntity="BuildType")
     * @ORM\JoinColumn(name="build_type_id", referencedColumnName="id")
     */
    protected $buildType;
    
    /**
     * @var string
     * 
     * @ORM\Column(type="string")
     */
    protected $slug;
    
    
    /**
     *
     * @var datetime
     * @ORM\Column(name="created", type="datetime", nullable=false) 
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
    
    public function __construct() {
        $this->created = new \DateTime();
        $this->modified = new \DateTime();
        $this->expired = new \DateTime();
    }

    public function __toString(){
        return $this->siteName;
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
     * Set siteName
     *
     * @param string $siteName
     *
     * @return WebsiteSale
     */
    public function setSiteName($siteName)
    {
        $this->siteName = $siteName;

        return $this;
    }

    /**
     * Get siteName
     *
     * @return string
     */
    public function getSiteName()
    {
        return $this->siteName;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return WebsiteSale
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
     * Set domain
     *
     * @param string $domain
     *
     * @return WebsiteSale
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return WebsiteSale
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
     * Set siteThumbnail
     *
     * @param string $siteThumbnail
     *
     * @return WebsiteSale
     */
    public function setSiteThumbnail($siteThumbnail)
    {
        $this->siteThumbnail = $siteThumbnail;

        return $this;
    }

    /**
     * Get siteThumbnail
     *
     * @return string
     */
    public function getSiteThumbnail()
    {
        return $this->siteThumbnail;
    }

    /**
     * Set detail
     *
     * @param string $detail
     *
     * @return WebsiteSale
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;

        return $this;
    }

    /**
     * Get detail
     *
     * @return string
     */
    public function getDetail($length=null)
    {
        if (false === is_null($length) && $length > 0)
            return substr($this->detail, 0, $length);
        else
            return $this->detail;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return WebsiteSale
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return WebsiteSale
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
     * Set user
     *
     * @param \Bidweb\UserBundle\Entity\User $user
     *
     * @return WebsiteSale
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
     * Set serverType
     *
     * @param \Bidweb\BidwebBundle\Entity\ServerType $serverType
     *
     * @return WebsiteSale
     */
    public function setServerType(\Bidweb\BidwebBundle\Entity\ServerType $serverType = null)
    {
        $this->serverType = $serverType;

        return $this;
    }

    /**
     * Get serverType
     *
     * @return \Bidweb\BidwebBundle\Entity\ServerType
     */
    public function getServerType()
    {
        return $this->serverType;
    }

    /**
     * Set buildType
     *
     * @param \Bidweb\BidwebBundle\Entity\BuildType $buildType
     *
     * @return WebsiteSale
     */
    public function setBuildType(\Bidweb\BidwebBundle\Entity\BuildType $buildType = null)
    {
        $this->buildType = $buildType;

        return $this;
    }

    /**
     * Get buildType
     *
     * @return \Bidweb\BidwebBundle\Entity\BuildType
     */
    public function getBuildType()
    {
        return $this->buildType;
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
    
    public function getAbsoluteLogo()
    {
        return null === $this->logo ? null : $this->getUploadRootDir().'/'.$this->logo;
    }
    
    public function getWebPathLogo()
    {
        return null === $this->logo ? null : $this->getUploadDir().'/'.$this->logo;
    }
    
    public function getAbsoluteSiteThumbnail()
    {
        return null === $this->siteThumbnail ? null : $this->getUploadRootDir().'/'.$this->siteThumbnail;
    }
    
    public function getWebPathSiteThumbnail()
    {
        return null === $this->siteThumbnail ? null : $this->getUploadDir().'/'.$this->siteThumbnail;
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
     * @Assert\File(maxSize="6000000")
     */
    public $file;
    
    /**
     * @Assert\File(maxSize="6000000")
     */
    public $file2;
    
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
        
        if($this->file2 !== null){
            $this->file2->move($this->getUploadRootDir(),  $this->siteThumbnail);
            
            unset($this->file2);
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
        
        if (null !== $this->file2) {
            // faites ce que vous voulez pour générer un nom unique
            $this->siteThumbnail = sha1(uniqid(mt_rand(), true)).'.'.$this->file2->guessExtension();
        }
        
        
    }
    
    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($this->file = $this->getAbsoluteLogo()) {
            unlink($this->file);
        }
        
        if ($this->file2 = $this->getAbsoluteSiteThumbnail()) {
            unlink($this->file2);
        }
        
        
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return WebsiteSale
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
     * Set expired
     *
     * @param \DateTime $expired
     *
     * @return WebsiteSale
     */
    public function setExpired($expired)
    {
        $this->expired = $expired;

        return $this;
    }

    /**
     * Get expired
     *
     * @return \DateTime
     */
    public function getExpired()
    {
        return $this->expired;
    }

    /**
     * Set modified
     *
     * @param \DateTime $modified
     *
     * @return WebsiteSale
     */
    public function setModified($modified)
    {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime
     */
    public function getModified()
    {
        return $this->modified;
    }
}
