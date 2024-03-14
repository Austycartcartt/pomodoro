<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;
use App\Entity\PomodoroTimer;

class PomodoroTimerCompleteEvent extends Event
{
    public const NAME = 'pomodoro_timer.complete';

    private PomodoroTimer $pomodoroTimer;

    public function __construct(PomodoroTimer $pomodoroTimer)
    {
        $this->pomodoroTimer = $pomodoroTimer;
    }

    public function getPomodoroTimer(): PomodoroTimer
    {
        return $this->pomodoroTimer;
    }
}