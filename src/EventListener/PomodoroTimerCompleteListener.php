<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mercure\PublisherInterface;
use Symfony\Component\Mercure\Update;
use App\Event\PomodoroTimerCompleteEvent;

class PomodoroTimerCompleteListener implements EventSubscriberInterface
{
    private PublisherInterface $publisher;

    public function __construct(PublisherInterface $publisher)
    {
        $this->publisher = $publisher;
    }

    public static function getSubscribedEvents()
    {
        return [
            PomodoroTimerCompleteEvent::class => 'onPomodoroTimerComplete',
        ];
    }

    public function onPomodoroTimerComplete(PomodoroTimerCompleteEvent $event)
    {
        $pomodoroTimer = $event->getPomodoroTimer();

        // Publish a message to the Mercure hub when the PomodoroTimer is complete
        $this->publisher->publish(new Update(
            'https://localhost/hub',
            json_encode(['message' => 'PomodoroTimer completed: ' . $pomodoroTimer->getId()]),
        ));
    }
}
