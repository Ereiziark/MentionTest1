<?php
use Mention\Kebab\Clock\Clock;
use Mention\Kebab\File\FileUtils;
use PHPUnit\Framework\TestCase;
use Qsl\MentionTest1;

class MyTest extends TestCase
{
    private string $resultOrginal;
    private string $resultOptimized;

    private const RESSOURCEFOLDER = "./resources/";
    private string $fileOut = self::RESSOURCEFOLDER."test1.out";
    public function test()
    {
        $start = Clock::hrtimeInt();
        MentionTest1::originalSearch(self::RESSOURCEFOLDER."words", self::RESSOURCEFOLDER."test1.in");
        $end = Clock::hrtimeInt();

        $resultOrginal = FileUtils::read($this->fileOut);
        $intervalOriginal = $end - $start;

        $start = Clock::hrtimeInt();
        MentionTest1::optimizedSearch(self::RESSOURCEFOLDER."words", self::RESSOURCEFOLDER."test1.in");
        $end = Clock::hrtimeInt();

        $resultOptimized = FileUtils::read($this->fileOut);

        $intervalOptimized = $end - $start;

        self::assertGreaterThan($intervalOptimized, $intervalOriginal);

        self::assertSame($resultOrginal, $resultOptimized);
    }
}