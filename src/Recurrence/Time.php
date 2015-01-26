<?php
/**
 * @author Alex Phillips <aphillips@cbcnewmedia.com>
 * Date: 1/23/15
 * Time: 9:24 PM
 */

namespace Recurrence;

class Time
{
    private $raw;
    private $hour = 0;
    private $minute = 00;
    private $meridiem = '';
    private $format = "g:ia";

    /**
     * @var bool $_omitTrailingZeroes Bolean to omit minutes from times
     *                                if the minutes are 00
     */
    private $_omitTrailingZeroes = true;

    /**
     * @var bool $_omitUnavailableMeridiem Boolean to omit am/pm notation
     *                                     if none is present in the parsed
     *                                     string
     */
    private $_omitUnavailableMeridiem = true;

    public function __construct($time = null)
    {
        $time = trim($time, " \t\n\r\0\x0B,-");
        $time = preg_replace('#\s+and(?:\s+|$)#', '', $time);

        $this->raw = $time;

        if (is_numeric($time)) {
            $time = $time . ":00";
        }

        // Handle military time
        if ($time) {
            if (preg_match('#((?:a|p)m)#', $time, $matches)) {
                $this->meridiem = $matches[1];
            }
            else {
                list($hour, $minutes) = explode(':', $time);
                if ($hour > 12) {
                    $hour = $hour - 12;
                    $time = "{$hour}:{$minutes}pm";
                }
            }

            $info = date_parse($time);
            $this->hour = $info['hour'];
            if ($this->hour > 12) {
                $this->hour = $this->hour - 12;
            }
            $this->minute = $info['minute'];
        }
        else {
            // error
        }
    }

    /**
     * @return null
     */
    public function getRaw()
    {
        return $this->raw;
    }

    /**
     * @param null $raw
     */
    public function setRaw($raw)
    {
        $this->raw = $raw;
    }

    /**
     * @return mixed
     */
    public function getHour()
    {
        return $this->hour;
    }

    /**
     * @param mixed $hour
     */
    public function setHour($hour)
    {
        $this->hour = $hour;
    }

    /**
     * @return mixed
     */
    public function getMinute()
    {
        if ($this->minute < 10) {
            return "0$this->minute";
        }

        return $this->minute;
    }

    /**
     * @param mixed $minute
     */
    public function setMinute($minute)
    {
        $this->minute = $minute;
    }

    /**
     * @return null
     */
    public function getMeridiem()
    {
        return $this->meridiem;
    }

    /**
     * @param null $meridiem
     */
    public function setMeridiem($meridiem)
    {
        $this->meridiem = $meridiem;
    }

    public function toString()
    {
        return $this->__toString();
    }

    public function __toString()
    {
        $format = $this->format;
        $time = $this->getHour() . ":" . $this->getMinute() . $this->getMeridiem();
        $info = date_parse($time);

        // If no am/pm detected, omit if in the formatter
        if ($this->_omitUnavailableMeridiem) {
            if (!preg_match('#(?:a|p)m#', $time)) {
                $format = preg_replace('#A|a#', '', $format);
            }
        }
        if ($this->_omitTrailingZeroes) {
            if ($info['minute'] === 0) {
                $format = preg_replace('#:\S#', '', $format);
            }
        }

        return date($format, strtotime($time));
    }
}