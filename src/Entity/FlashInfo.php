<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FlashInfoRepository")
 */
class FlashInfo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\FlashInfoObjet", cascade={"persist", "remove"})
     * @Assert\Expression("value != this.getEmplacement2() and value != this.getEmplacement3() and value != this.getEmplacement4() and value != this.getEmplacement5() or value == null", message="Attention cette emplacement doit être unique")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $emplacement1;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\FlashInfoObjet", cascade={"persist", "remove"})
     * @Assert\Expression("value != this.getEmplacement1() and value != this.getEmplacement3() and value != this.getEmplacement4() and value != this.getEmplacement5() or value == null", message="Attention cette emplacement doit être unique")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $emplacement2;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\FlashInfoObjet", cascade={"persist", "remove"})
     * @Assert\Expression("value != this.getEmplacement2() and value != this.getEmplacement1() and value != this.getEmplacement4() and value != this.getEmplacement5() or value == null", message="Attention cette emplacement doit être unique")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $emplacement3;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\FlashInfoObjet", cascade={"persist", "remove"})
     * @Assert\Expression("value != this.getEmplacement2() and value != this.getEmplacement3() and value != this.getEmplacement1() and value != this.getEmplacement5() or value == null", message="Attention cette emplacement doit être unique")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $emplacement4;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\FlashInfoObjet", cascade={"persist", "remove"})
     * @Assert\Expression("value != this.getEmplacement2() and value != this.getEmplacement3() and value != this.getEmplacement4() and value != this.getEmplacement1() or value == null", message="Attention cette emplacement doit être unique")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $emplacement5;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmplacement1(): ?FlashInfoObjet
    {
        return $this->emplacement1;
    }

    public function setEmplacement1(?FlashInfoObjet $emplacement1): self
    {
        $this->emplacement1 = $emplacement1;

        return $this;
    }

    public function getEmplacement2(): ?FlashInfoObjet
    {
        return $this->emplacement2;
    }

    public function setEmplacement2(?FlashInfoObjet $emplacement2): self
    {
        $this->emplacement2 = $emplacement2;

        return $this;
    }

    public function getEmplacement3(): ?FlashInfoObjet
    {
        return $this->emplacement3;
    }

    public function setEmplacement3(?FlashInfoObjet $emplacement3): self
    {
        $this->emplacement3 = $emplacement3;

        return $this;
    }

    public function getEmplacement4(): ?FlashInfoObjet
    {
        return $this->emplacement4;
    }

    public function setEmplacement4(?FlashInfoObjet $emplacement4): self
    {
        $this->emplacement4 = $emplacement4;

        return $this;
    }

    public function getEmplacement5(): ?FlashInfoObjet
    {
        return $this->emplacement5;
    }

    public function setEmplacement5(?FlashInfoObjet $emplacement5): self
    {
        $this->emplacement5 = $emplacement5;

        return $this;
    }

    /**
     * Permet de récuperer chaque emplacement du flash d'informations
     */
    public function getAllEmplacement()
    {
        $emplacements[] = $this->emplacement1;
        $emplacements[] = $this->emplacement2;
        $emplacements[] = $this->emplacement3;
        $emplacements[] = $this->emplacement4;
        $emplacements[] = $this->emplacement5;
        $empty = true;
        foreach($emplacements as $emplacement) {
            if (isset($emplacement)) {
                $empty = false;
                $flashInfo[]  = $emplacement;
            }
        }
        if ($empty) {
            return null;
        } else {
            return $flashInfo;
        }
    }
}
