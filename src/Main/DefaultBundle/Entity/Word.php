<?php
namespace Main\DefaultBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Table()
 * @ORM\Entity
 */
class Word
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $word;

    /**
     * @ORM\Column(type="string", length=5)
     */
    protected $lang;

    /**
     * @ORM\Column(type="integer")
     */
    protected $certified = 0;

    /**
     * @ORM\ManyToMany(targetEntity="Dictionary", mappedBy="words")
     **/
    private $dictionaries;
    
    /**
     * @ORM\OneToMany(targetEntity="Translation", mappedBy="word",cascade={"persist"})
     */
    protected $translations;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set word
     *
     * @param string $word
     * @return Word
     */
    public function setWord($word)
    {
        $this->word = $word;

        return $this;
    }

    /**
     * Get word
     *
     * @return string 
     */
    public function getWord()
    {
        return $this->word;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Word
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
     * Add translations
     *
     * @param \Main\DefaultBundle\Entity\Translation $translations
     * @return Word
     */
    public function addTranslation(\Main\DefaultBundle\Entity\Translation $translations)
    {
        $this->translations[] = $translations;

        return $this;
    }

    /**
     * Remove translations
     *
     * @param \Main\DefaultBundle\Entity\Translation $translations
     */
    public function removeTranslation(\Main\DefaultBundle\Entity\Translation $translations)
    {
        $this->translations->removeElement($translations);
    }

    /**
     * Get translations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * Add dictionaries
     *
     * @param \Main\DefaultBundle\Entity\Dictionary $dictionaries
     * @return Word
     */
    public function addDictionary(\Main\DefaultBundle\Entity\Dictionary $dictionaries)
    {
        $this->dictionaries[] = $dictionaries;

        return $this;
    }

    /**
     * Remove dictionaries
     *
     * @param \Main\DefaultBundle\Entity\Dictionary $dictionaries
     */
    public function removeDictionary(\Main\DefaultBundle\Entity\Dictionary $dictionaries)
    {
        $this->dictionaries->removeElement($dictionaries);
    }

    /**
     * Get dictionaries
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDictionaries()
    {
        return $this->dictionaries;
    }
}
