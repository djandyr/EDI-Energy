<?php

namespace Proengeno\EdiEnergy\StreamFilter;

class Utf8ToIso extends \php_user_filter
{
    const TO_CHAR = 'ISO-8859-1';
    const FROM_CHAR = 'UTF-8, CP1252, ISO-8859-1';

    public function filter($in, $out, &$consumed, $closing)
    {
        while ($bucket = stream_bucket_make_writeable($in)) {
            $bucket->data = $this->convertToIso($bucket->data);

            $consumed += $bucket->datalen;
            stream_bucket_append($out, $bucket);
        }

        return PSFS_PASS_ON;
    }

    private function convertToIso($string)
    {
        $fromCharset = mb_detect_encoding($string, self::FROM_CHAR);

        if ($fromCharset && $fromCharset != self::TO_CHAR && $connvertedString = iconv($fromCharset, self::TO_CHAR, $string)) {
            return $connvertedString;
        }

        return $string;
    }
}
