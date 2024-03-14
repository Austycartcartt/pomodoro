<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TaskRepository::class)]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['task'])]
    private ?int $id = null;

    #[Groups(['task'])]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Groups(['task'])]
    #[ORM\OneToMany(targetEntity: PomodoroSession::class, mappedBy: 'task')]
    private Collection $startTime;

    public function __construct()
    {
        $this->startTime = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, PomodoroSession>
     */
    public function getStartTime(): Collection
    {
        return $this->startTime;
    }

    public function addStartTime(PomodoroSession $startTime): static
    {
        if (!$this->startTime->contains($startTime)) {
            $this->startTime->add($startTime);
            $startTime->setTask($this);
        }

        return $this;
    }

    public function removeStartTime(PomodoroSession $startTime): static
    {
        if ($this->startTime->removeElement($startTime)) {
            // set the owning side to null (unless already changed)
            if ($startTime->getTask() === $this) {
                $startTime->setTask(null);
            }
        }

        return $this;
    }
}
