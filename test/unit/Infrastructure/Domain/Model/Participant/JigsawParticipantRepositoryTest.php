<?php

namespace PODEntender\Infrastructure\Domain\Model\Participant;

use PODEntender\Domain\Model\Participant\Participant;
use PHPUnit\Framework\TestCase;
use TightenCo\Jigsaw\IterableObject;
use TightenCo\Jigsaw\Jigsaw;
use TightenCo\Jigsaw\PageVariable;

class JigsawParticipantRepositoryTest extends TestCase
{
    private $jigsaw;

    private $participantRepository;

    public function setUp(): void
    {
        $this->jigsaw = $this->prophesize(Jigsaw::class);
        $this->participantRepository = new JigsawParticipantRepository($this->jigsaw->reveal());
    }

    public function testByEpisode(): void
    {
        $this->jigsaw->getCollection('episodes')->willReturn(new PageVariable([
            $this->buildNewPage('2019-01-01', ['Nickolas', 'Tchecão'], '001'),
            $this->buildNewPage('2019-01-08', ['Dalton', 'Katarina'], '002'),
        ]));

        $participants = $this->participantRepository->byEpisode('001')
            ->map(function (Participant $participant) {
                return $participant->name();
            });

        $this->assertEquals('Nickolas', $participants->first());
        $this->assertEquals('Tchecão', $participants->last());

        $participants = $this->participantRepository->byEpisode('002')
            ->map(function (Participant $participant) {
                return $participant->name();
            });

        $this->assertEquals('Dalton', $participants->first());
        $this->assertEquals('Katarina', $participants->last());
    }

    public function testAll()
    {
        $this->jigsaw->getCollection('episodes')->willReturn(new PageVariable([
            $this->buildNewPage('2019-01-01', ['Nickolas', 'Tchecão'], '001'),
            $this->buildNewPage('2019-01-08', ['Dalton', 'Katarina'], '002'),
        ]));

        $participants = $this->participantRepository->all();

        $this->assertEquals('Nickolas', $participants->get(0)->name());
        $this->assertEquals('Tchecão', $participants->get(1)->name());
        $this->assertEquals('Dalton', $participants->get(2)->name());
        $this->assertEquals('Katarina', $participants->get(3)->name());
    }

    private function buildNewPage(string $postDate, array $participants, ?string $number = 'default'): PageVariable
    {
        $participants = array_map(function (string $name) {
            return [
                'name' => $name,
                'picture' => '',
                'description' => '',
            ];
        }, $participants);

        return new PageVariable([
            'extends' => '_layouts/test-base',
            'postDate' => strtotime($postDate),
            'category' => 'episodio',
            'date' => strtotime($postDate),
            'participants' => $participants,
            'episode' => [
                'number' => $number,
                'title' => '',
                'description' => '',
                'author' => '',
                'date' => strtotime($postDate),
                'audioUrl' => $postDate . '.mp3',
                'cover' => [
                    'url' => '',
                ],
            ],
            '_meta' => new IterableObject([
                'baseUrl' => 'tmp://test.env',
                'category' => 'episodio',
                'content' => 'dummy content',
                'collectionName' => 'episodes',
                'url' => '/test/' . $postDate . '.html',
                'filename' => 'test/filename/' . $postDate . '.md',
            ]),
        ]);
    }
}
