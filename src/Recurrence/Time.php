<?php
/**
 * @author Alex Phillips <aphillips@cbcnewmedia.com>
 * Date: 1/23/15
 * Time: 9:24 PM
 */

namespace Recurrence;

class Time
{
    /**
     * @var string $raw The raw time string used to construct the object
     */
    private $raw = '';
    private $hour = '';
    private $minute = '';
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
        if ($time) {
            $this->raw = $time;

            $time = trim($time, " \t\n\r\0\x0B,-");
            $time = preg_replace('#\s+and(?:\s+|$)#', '', $time);

            if (is_numeric($time)) {
                $time = $time . ":00";
            }

            // Handle military time
            if ($time) {
                if (preg_match('#((?:a|p)m)#', $time, $matches)) {
                    $this->meridiem = $matches[1];
                }

                $info = date_parse($time);
                $this->setHour($info['hour']);
                $this->setMinute($info['minute']);
            }
            else {
                // error
            }
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
     * @return mixed
     */
    public function getHour()
    {
        return $this->hour;
    }

    /**
     * @param $hour
     *
     * @return $this Time This Time instance for fluent method calls
     */
    public function setHour($hour)
    {
        if ($hour > 12) {
            $hour = $hour - 12;
        }

        $this->hour = $hour;

        return $this;
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
     * @param $minute
     *
     * @return $this Time This Time instance for fluent method calls
     */
    public function setMinute($minute)
    {
        $this->minute = $minute;

        return $this;
    }

    /**
     * @return null
     */
    public function getMeridiem()
    {
        return $this->meridiem;
    }

    /**
     * @param $meridiem string The meridiem (am/pm) value of the time
     *
     * @return $this Time This Time instance for fluent method calls
     */
    public function setMeridiem($meridiem)
    {
        $meridiem = strtolower(trim(str_replace('.', '', $meridiem)));
        $this->meridiem = $meridiem;

        return $this;
    }

    public function toString()
    {
        return $this->__toString();
    }

    /**
     * Convert Time object into a
     *
     * @return bool|string
     */
    public function __toString()
    {
        if ($this->raw) {
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

        return $this->raw;
    }
}