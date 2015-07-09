<?php
namespace Main\DefaultBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Main\DefaultBundle\Repository\WordRepository")
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
    protected $local;

    /**
     * @ORM\Column(type="integer")
     */
    protected $certified = 0;

    /**
     * @ORM\ManyToMany(targetEntity="Dictionary", mappedBy="words")
     **/
    private $dictionaries;

    /**
     * @ORM\ManyToMany(targetEntity="GroupWord", mappedBy="words")
     **/
    private $groupsWords;

    /**
     * @ORM\ManyToMany(targetEntity="Test", mappedBy="words")
     **/
    private $testsWords;

    /**
     * @ORM\OneToMany(targetEntity="Point", mappedBy="word",cascade={"persist"})
     */
    protected $points;

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

    public function __toString() {
        return $this->word;
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
     * Set local
     *
     * @param string $local
     * @return Word
     */
    public function setLocal($local)
    {
        $this->local = $local;

        return $this;
    }

    /**
     * Get local
     *
     * @return string 
     */
    public function getLocal()
    {
        return $this->local;
    }

    /**
     * Set certified
     *
     * @param integer $certified
     * @return Word
     */
    public function setCertified($certified)
    {
        $this->certified = $certified;

        return $this;
    }

    /**
     * Get certified
     *
     * @return integer 
     */
    public function getCertified()
    {
        return $this->certified;
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

    /**
     * Add groupsWords
     *
     * @param \Main\DefaultBundle\Entity\GroupWord $groupsWords
     * @return Word
     */
    public function addGroupsWord(\Main\DefaultBundle\Entity\GroupWord $groupsWords)
    {
        $this->groupsWords[] = $groupsWords;

        return $this;
    }

    /**
     * Remove groupsWords
     *
     * @param \Main\DefaultBundle\Entity\GroupWord $groupsWords
     */
    public function removeGroupsWord(\Main\DefaultBundle\Entity\GroupWord $groupsWords)
    {
        $this->groupsWords->removeElement($groupsWords);
    }

    /**
     * Get groupsWords
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGroupsWords()
    {
        return $this->groupsWords;
    }

    /**
     * Add points
     *
     * @param \Main\DefaultBundle\Entity\Point $points
     * @return Word
     */
    public function addPoint(\Main\DefaultBundle\Entity\Point $points)
    {
        $this->points[] = $points;

        return $this;
    }

    /**
     * Remove points
     *
     * @param \Main\DefaultBundle\Entity\Point $points
     */
    public function removePoint(\Main\DefaultBundle\Entity\Point $points)
    {
        $this->points->removeElement($points);
    }

    /**
     * Get points
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Add testsWords
     *
     * @param \Main\DefaultBundle\Entity\Test $testsWords
     * @return Word
     */
    public function addTestsWord(\Main\DefaultBundle\Entity\Test $testsWords)
    {
        $this->testsWords[] = $testsWords;

        return $this;
    }

    /**
     * Remove testsWords
     *
     * @param \Main\DefaultBundle\Entity\Test $testsWords
     */
    public function removeTestsWord(\Main\DefaultBundle\Entity\Test $testsWords)
    {
        $this->testsWords->removeElement($testsWords);
    }

    /**
     * Get testsWords
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTestsWords()
    {
        return $this->testsWords;
    }
}
