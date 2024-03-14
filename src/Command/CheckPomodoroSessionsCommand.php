<?php


namespace App\Command;

use App\Entity\PomodoroSession;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Event\PomodoroTimerCompleteEvent;
use App\Entity\PomodoroTimer;

class CheckPomodoroSessionsCommand extends Command
{
    protected static $defaultName = 'app:check-pomodoro-sessions';

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();

        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this->setDescription('Checks PomodoroSessions for completion every minute');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $currentDateTime = new \DateTime();

        $pomodoroSessions = $this->entityManager->getRepository(PomodoroSession::class)->findBy([
            'endTime' => $currentDateTime,
        ]);

        foreach ($pomodoroSessions as $pomodoroSession) {
            $pomodoroSession->setStatus('completed');
            $this->entityManager->flush();
            $eventDispatcher->dispatch(new PomodoroTimerCompleteEvent($pomodoroTimer), PomodoroTimerCompleteEvent::NAME);
            $output->writeln("PomodoroSession {$pomodoroSession->getId()} completed.");
        }

        return Command::SUCCESS;
    }
}
