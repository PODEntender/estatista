<?php

namespace PODEntender\Domain\Model\FileProcessing\RobotsTxt;

class RobotsTxtStringBuilder
{
    public function build(RobotsTxt $robot): string
    {
        $robotsTxt = ['Sitemap: ' . $robot->sitemap()];
        $rules = $robot->ruleSetCollection()
            ->map(function (RulesSet $rule) {
                return array_merge(
                    [
                        '',
                        'User-Agent: ' . $rule->userAgent(),
                    ],
                    array_map(function ($string) {
                        return "Allow: $string";
                    }, $rule->allowRules()),
                    array_map(function ($string) {
                        return "Disallow: $string";
                    }, $rule->disallowRules())
                );
            })
            ->flatten()
            ->toArray();

        return implode(PHP_EOL, array_merge($robotsTxt, $rules));
    }
}
