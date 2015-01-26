<?php
/**
 * @author Alex Phillips <aphillips@cbcnewmedia.com>
 * Date: 1/23/15
 * Time: 9:43 PM
 */

namespace Recurrence;

use DateTime;
use Exception;

class Date extends DateTime
{
    private $raw;

    public function __construct($dateString = 'now')
    {
        $this->raw = $dateString;
        parent::__construct($dateString);
    }

    public function getRawString()
    {
        return $this->raw;
    }

    public static function createFromTimestamp($timestamp)
    {
        $date = new Date();
        $date->setRawString($timestamp);
        $date->setTimestamp($timestamp);

        return $date;
    }

    private function setRawString($dateString)
    {
        $this->raw = $dateString;
    }
}