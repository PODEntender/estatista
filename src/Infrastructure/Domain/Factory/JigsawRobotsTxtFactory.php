<?php

namespace PODEntender\Infrastructure\Domain\Factory;

use PODEntender\Domain\Model\FileProcessing\RobotsTxt\RobotsTxt;
use Illuminate\Support\Collection;
use PODEntender\Domain\Model\FileProcessing\RobotsTxt\RulesSetCollection;
use PODEntender\Domain\Model\FileProcessing\RobotsTxt\RulesSet;

class JigsawRobotsTxtFactory
{
    public function newRobotsTxtFromConfiguration(Collection $configuration): RobotsTxt
    {
        return new RobotsTxt(
            $configuration['sitemap'],
            new RulesSetCollection($configuration['rulesSetCollection']->map(function (Collection $rules) {
                $rulesSet = new RulesSet($rules['User-Agent']);
                $rulesSet->addAllowRules($rules['Allow']->toArray());
                $rulesSet->addDisallowRules($rules['Disallow']->toArray());

                return $rulesSet;
            }))
        );
    }
}
