<?php

namespace PODEntender\Infrastructure\Domain\Model\Participant;

use PODEntender\Domain\Model\Participant\Participant;
use PODEntender\Domain\Model\Participant\ParticipantCollection;
use PODEntender\Domain\Model\Participant\ParticipantRepository;
use TightenCo\Jigsaw\Jigsaw;
use TightenCo\Jigsaw\PageVariable;

class JigsawParticipantRepository implements ParticipantRepository
{
    private $jigsaw;

    public function __construct(Jigsaw $jigsaw)
    {
        $this->jigsaw = $jigsaw;
    }

    public function all(): ParticipantCollection
    {
        return new ParticipantCollection(
            $this->jigsaw
                ->getCollection('episodes')
                ->filter(function (PageVariable $page) {
                    return count($page->participants ?? []) > 0;
                })
                ->map(function (PageVariable $page) {
                    return $page->participants;
                })
                ->flatten(1)
                ->map(function (array $participantMap) {
                    return new Participant(
                        $participantMap['name'],
                        $participantMap['picture'],
                        $participantMap['description']
                    );
                })
                ->unique(function (Participant $participant) {
                    return $participant->name();
                })
        );
    }

    public function byEpisode(string $number): ParticipantCollection
    {
        return new ParticipantCollection(
            $this->jigsaw
                ->getCollection('episodes')
                ->filter(function (PageVariable $page) use ($number) {
                    return $page->episode['number'] === $number && count($page->participants ?? []) > 0;
                })
                ->map(function (PageVariable $page) {
                    return $page->participants;
                })
                ->flatten(1)
                ->map(function (array $participantMap) {
                    return new Participant(
                        $participantMap['name'],
                        $participantMap['picture'],
                        $participantMap['description']
                    );
                })
        );
    }
}
