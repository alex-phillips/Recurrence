<?php
/**
 * @author Alex Phillips <aphillips@cbcnewmedia.com>
 * Date: 1/23/15
 * Time: 9:43 PM
 */

namespace Recurrence;

class Instance
{
    private $rawTime;
    private $startTime;
    private $startDescription = '';
    private $endTime;
    private $endDescription = '';

    public function __construct($rawTime, $starTime = null, $endTime = null, $startDescription = null, $endDescription = null)
    {
        $this->rawTime = $rawTime;
        $this->startTime = $starTime;
        $this->endTime = $endTime;
        $this->startDescription = $startDescription;
        $this->endDescription = $endDescription;
    }

    /**
     * @return mixed
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @param mixed $startTime
     */
    public function setStartTime($startTime)
    {
        $startTime = $this->formatTime($startTime);
        $this->startTime = new Time($startTime);
        $this->formatInstance();
    }

    /**
     * @return mixed
     */
    public function getStartDescription()
    {
        return $this->startDescription;
    }

    /**
     * @param mixed $startDescription
     */
    public function setStartDescription($startDescription)
    {
        $this->startDescription = trim($startDescription);
    }

    /**
     * @return mixed
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @param mixed $endTime
     */
    public function setEndTime($endTime)
    {
        $endTime = $this->formatTime($endTime);
        $this->endTime = new Time($endTime);
        $this->formatInstance();
    }

    /**
     * @return mixed
     */
    public function getEndDescription()
    {
        return $this->endDescription;
    }

    /**
     * @param mixed $endDescription
     */
    public function setEndDescription($endDescription)
    {
        $this->endDescription = trim($endDescription);
    }

    public function __toString()
    {
        $times = array();
        if ($this->getStartTime()) {
            $time = $this->getStartTime()->toString();
            if ($this->getStartDescription()) {
                $time = $this->getStartDescription() . " $time";
            }

            $times[] = $time;
        }
        if ($this->getEndTime()) {
            $time = $this->getEndTime()->toString();
            if ($this->getEndDescription()) {
                $time = $this->getEndDescription() . " $time";
            }

            $times[] = $time;
        }

        return implode('-', $times);
    }

    public function toString()
    {
        return $this->__toString();
    }

    private function formatTime($time)
    {
        $time = trim($time, " \t\n\r\0\x0B,-");
        $time = preg_replace('#\s+and(?:\s+|$)#', '', $time);

        return $time;
    }

    private function formatInstance()
    {
        // Make assumptions about am/pm if not available
        if ($this->startTime && $this->endTime) {
            if (!$this->getStartTime()->getMeridiem() && !$this->getEndTime()->getMeridiem()) {
                if ($this->getStartTime()->getHour() > $this->getEndTime()->getHour()) {
                    $this->getStartTime()->setMeridiem('am');
                    $this->getEndTime()->setMeridiem('pm');
                }
            }
        }
    }
}