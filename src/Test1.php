<?php
require "../vendor/autoload.php";

use Qsl\MentionTest1;

MentionTest1::originalSearch($argv[1], $argv[2]);
MentionTest1::optimizedSearch($argv[1], $argv[2]);