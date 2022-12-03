<?php

namespace Qsl;

use Mention\Kebab\File\FileUtils;
use Mention\Kebab\File\Exception\FileUtilsReadException;
use Mention\Kebab\Pcre\PcreUtils;

class MentionTest1 {

    private static function readWords($file) 
    {
        try {
            $data = FileUtils::read($file);
        } catch(FileUtilsReadException $ex) {
            printf("Error while opening : %s\n%s", $file, $ex->getMessage());
            throw $ex;
        }
        
        PcreUtils::matchAll('#[^ \n]+#', $data, $m);

        return $m[0];
    }

    public static function originalSearch(string $dictionaryPath, string $lookupPath): void
    {
        $validWords = self::readWords($dictionaryPath);
        $inputWords = self::readWords($lookupPath);
        foreach ($inputWords as $inputWord) {
            if (in_array($inputWord, $validWords)) {
                printf("%s\n", $inputWord);
            } else {
                printf("<%s>\n", $inputWord);
            }
        }
    }

    public static function optimizedSearch(string $dictionaryPath, string $lookupPath): void 
    {
        $validWords = array_flip(self::readWords($dictionaryPath));
        $inputWords = self::readWords($lookupPath);

        foreach ($inputWords as $inputWord) {
            if (array_key_exists($inputWord, $validWords)) {
                printf("%s\n", $inputWord);
            } else {
                printf("<%s>\n", $inputWord);
            }
        }
    }
}
