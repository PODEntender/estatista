<?php

namespace PODEntender\Domain\Model\Participant;

interface ParticipantRepository
{
    public function all(): ParticipantCollection;

    public function byEpisode(string $number): ParticipantCollection;
}
