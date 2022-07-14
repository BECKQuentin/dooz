<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoomRepository::class)
 */
class Room
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $episode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name_en;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description_en;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $banner;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $thumbnail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $clock_thumbnail;

    /**
     * @ORM\ManyToOne(targetEntity=Address::class, inversedBy="rooms")
     */
    private $address;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $difficulty;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $stress;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fear;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minPlayers;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxPlayers;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duration;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $record;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $recordLost;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $short_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $short_name_en;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $main_mission;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $main_mission_en;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $side_mission;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $side_mission_en;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $additional_feature;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $additional_feature_en;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $forescape_data_room;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $textBanner;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isTextBanner;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $warningDescription;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $warningDescriptionEn;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isWarningDescription;

    public function __construct()
    {
        $this->setUpdatedAt(new \DateTimeImmutable('now'));
        $this->setSlug('test');
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTimeImmutable('now'));
        }

    }

    public function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('#[^\\pL\d]+#u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        if (function_exists('iconv'))
        {
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        }

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('#[^-\w]+#', '', $text);

        if (empty($text))
        {
            return 'n-a';
        }

        return $text;
    }

    public function getThumbnailImageDirectory(): string
    {
        return '/'.'escape'.'/'.'thumbnail';
    }
    public function getBannerImageDirectory(): string
    {
        return '/'.'escape'.'/'.'banner';
    }
    public function getClockImageDirectory(): string
    {
        return '/'.'escape'.'/'.'clock';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getEpisode(): ?string
    {
        return $this->episode;
    }

    public function setEpisode(?string $episode): self
    {
        $this->episode = $episode;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getNameEn(): ?string
    {
        return $this->name_en;
    }

    public function setNameEn(?string $name_en): self
    {
        $this->name_en = $name_en;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDescriptionEn(): ?string
    {
        return $this->description_en;
    }

    public function setDescriptionEn(?string $description_en): self
    {
        $this->description_en = $description_en;

        return $this;
    }

    public function getBanner(): ?string
    {
        return $this->banner;
    }

    public function setBanner(?string $banner): self
    {
        $this->banner = $banner;

        return $this;
    }

    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(?string $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    public function getClockThumbnail(): ?string
    {
        return $this->clock_thumbnail;
    }

    public function setClockThumbnail(?string $clock_thumbnail): self
    {
        $this->clock_thumbnail = $clock_thumbnail;

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDifficulty(): ?int
    {
        return $this->difficulty;
    }

    public function setDifficulty(?int $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getStress(): ?int
    {
        return $this->stress;
    }

    public function setStress(?int $stress): self
    {
        $this->stress = $stress;

        return $this;
    }

    public function getFear(): ?int
    {
        return $this->fear;
    }

    public function setFear(?int $fear): self
    {
        $this->fear = $fear;

        return $this;
    }

    public function getMinPlayers(): ?int
    {
        return $this->minPlayers;
    }

    public function setMinPlayers(?int $minPlayers): self
    {
        $this->minPlayers = $minPlayers;

        return $this;
    }

    public function getMaxPlayers(): ?int
    {
        return $this->maxPlayers;
    }

    public function setMaxPlayers(?int $maxPlayers): self
    {
        $this->maxPlayers = $maxPlayers;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getRecord(): ?int
    {
        return $this->record;
    }

    public function setRecord(?int $record): self
    {
        $this->record = $record;

        return $this;
    }

    public function getRecordLost(): ?int
    {
        return $this->recordLost;
    }

    public function setRecordLost(?int $recordLost): self
    {
        $this->recordLost = $recordLost;

        return $this;
    }

    public function getShortName(): ?string
    {
        return $this->short_name;
    }

    public function setShortName(?string $short_name): self
    {
        $this->short_name = $short_name;

        return $this;
    }

    public function getShortNameEn(): ?string
    {
        return $this->short_name_en;
    }

    public function setShortNameEn(?string $short_name_en): self
    {
        $this->short_name_en = $short_name_en;

        return $this;
    }

    public function getMainMission(): ?string
    {
        return $this->main_mission;
    }

    public function setMainMission(?string $main_mission): self
    {
        $this->main_mission = $main_mission;

        return $this;
    }

    public function getMainMissionEn(): ?string
    {
        return $this->main_mission_en;
    }

    public function setMainMissionEn(?string $main_mission_en): self
    {
        $this->main_mission_en = $main_mission_en;

        return $this;
    }

    public function getSideMission(): ?string
    {
        return $this->side_mission;
    }

    public function setSideMission(?string $side_mission): self
    {
        $this->side_mission = $side_mission;

        return $this;
    }

    public function getSideMissionEn(): ?string
    {
        return $this->side_mission_en;
    }

    public function setSideMissionEn(?string $side_mission_en): self
    {
        $this->side_mission_en = $side_mission_en;

        return $this;
    }

    public function getAdditionalFeature(): ?string
    {
        return $this->additional_feature;
    }

    public function setAdditionalFeature(?string $additional_feature): self
    {
        $this->additional_feature = $additional_feature;

        return $this;
    }

    public function getAdditionalFeatureEn(): ?string
    {
        return $this->additional_feature_en;
    }

    public function setAdditionalFeatureEn(?string $additional_feature_en): self
    {
        $this->additional_feature_en = $additional_feature_en;

        return $this;
    }

    public function getForescapeDataRoom(): ?string
    {
        return $this->forescape_data_room;
    }

    public function setForescapeDataRoom(?string $forescape_data_room): self
    {
        $this->forescape_data_room = $forescape_data_room;

        return $this;
    }

    public function getTextBanner(): ?string
    {
        return $this->textBanner;
    }

    public function setTextBanner(?string $textBanner): self
    {
        $this->textBanner = $textBanner;

        return $this;
    }

    public function getIsTextBanner(): ?bool
    {
        return $this->isTextBanner;
    }

    public function setIsTextBanner(?bool $isTextBanner): self
    {
        $this->isTextBanner = $isTextBanner;

        return $this;
    }

    public function getWarningDescription(): ?string
    {
        return $this->warningDescription;
    }

    public function setWarningDescription(?string $warningDescription): self
    {
        $this->warningDescription = $warningDescription;

        return $this;
    }

    public function getWarningDescriptionEn(): ?string
    {
        return $this->warningDescriptionEn;
    }

    public function setWarningDescriptionEn(?string $warningDescriptionEn): self
    {
        $this->warningDescriptionEn = $warningDescriptionEn;

        return $this;
    }

    public function isIsWarningDescription(): ?bool
    {
        return $this->isWarningDescription;
    }

    public function setIsWarningDescription(?bool $isWarningDescription): self
    {
        $this->isWarningDescription = $isWarningDescription;

        return $this;
    }

}
