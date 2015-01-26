<?php
/**
 * @author Alex Phillips <aphillips@cbcnewmedia.com>
 * Date: 1/23/15
 * Time: 9:43 PM
 */

namespace Recurrence;

use DateTime;

class Date extends DateTime
{
    /**
     * @var string $raw Raw value used to create the Date object
     */
    private $raw;

    /**
     * @param string $dateString
     */
    public function __construct($dateString = 'now')
    {
        $this->raw = $dateString;
        parent::__construct($dateString);
    }

    /**
     * Return the raw string used to create the Date object
     *
     * @return mixed The raw value used to create the Date object
     */
    public function getRawString()
    {
        return $this->raw;
    }

    /**
     * Set the raw string used to create the initial Date object. This should
     * only be called internally when using static fuctions to generate
     * a new instance.
     *
     * @param $dateString mixed The raw value used to create the Date object
     */
    private function setRawString($dateString)
    {
        $this->raw = $dateString;
    }

    /**
     * Use a numeric timestamp to create a new Date object
     *
     * @param $timestamp mixed Timestamp used to create Date object
     *
     * @return Date New Date instance
     */
    public static function createFromTimestamp($timestamp)
    {
        $date = new Date();
        $date->setRawString($timestamp);
        $date->setTimestamp($timestamp);

        return $date;
    }
}