<?php

namespace PODEntender\Application\Service\FileProcessing;

use PHPUnit\Framework\TestCase;
use PODEntender\Domain\Model\FileProcessing\RobotsTxt\RobotsTxt;
use PODEntender\Domain\Model\FileProcessing\RobotsTxt\RobotsTxtStringBuilder;
use PODEntender\Domain\Model\FileProcessing\RobotsTxt\RulesSetCollection;
use PODEntender\Domain\Model\FileProcessing\RobotsTxt\RulesSet;

class GenerateRobotsTxtFileTest extends TestCase
{
    public function testExecuteShouldNotModifyBuilder()
    {
        $robotsTxt = $this->prophesize(RobotsTxt::class);
        $builder = $this->prophesize(RobotsTxtStringBuilder::class);
        $builder->build($robotsTxt->reveal())
            ->willReturn('Built');
        $robotsTxtGenerator = new GenerateRobotsTxtFile($builder->reveal());
        
        $this->assertEquals('Built', $robotsTxtGenerator->execute($robotsTxt->reveal(), '')->content());
    }

    public function testExecuteShouldContainTheSitemapString()
    {
        $robotsTxt = new RobotsTxt('https://podentender.com/sitemap.xml', new RulesSetCollection());
        $builder = new RobotsTxtStringBuilder();
        $robotsTxtGenerator = new GenerateRobotsTxtFile($builder);

        $this->assertEquals('Sitemap: https://podentender.com/sitemap.xml', $robotsTxtGenerator->execute($robotsTxt, '')->content());
    }

    public function testExecuteShouldContainAnEmptyLineBetweenUserAgentDeclarationAndMultipleAllowsPerUserAgent()
    {
        $firstRuleSet = new RulesSet('*');
        $firstRuleSet->addAllowRules(['/home', '/blog']);
        $firstRuleSet->addDisallowRules(['/about']);
        $secondRuleSet = new RulesSet('AdsBot-Google');
        $secondRuleSet->addAllowRules(['/home', '/blog']);
        $secondRuleSet->addDisallowRules(['/about']);
        $robotsTxt = new RobotsTxt('https://podentender.com/sitemap.xml', new RulesSetCollection([$firstRuleSet, $secondRuleSet]));
        $builder = new RobotsTxtStringBuilder();
        $robotsTxtGenerator = new GenerateRobotsTxtFile($builder);
        $expected = 
<<<EOF
Sitemap: https://podentender.com/sitemap.xml

User-Agent: *
Allow: /home
Allow: /blog
Disallow: /about

User-Agent: AdsBot-Google
Allow: /home
Allow: /blog
Disallow: /about
EOF;
        $this->assertEquals($expected, $robotsTxtGenerator->execute($robotsTxt, '')->content());
    }
}
