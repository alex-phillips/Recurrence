<?php
/**
 * @author Alex Phillips <aphillips@cbcnewmedia.com>
 * Date: 1/23/15
 * Time: 8:43 PM
 */

namespace Recurrence;

use DateTime;
use Exception;

/**
 * Class Recurrence
 *
 * Class designed to accept any number and format of dates
 * and date/time combinations and consolidate them into groups
 * by consecutive dates and same occurrences during those days.
 *
 * Ex:
 *  Jan 3, 2015 1pm-3pm, 5pm-9pm
 *  Jan 4, 2015 1pm-3pm, 5pm-9pm
 *  Jan 5, 2015 1pm-3pm, 5pm-9pm
 *
 * These dates would be consolidated into a structure containing
 * the following:
 *  start date: Jan 3 [CURRENT YEAR]
 *  end date:   Jan 5, [CURRENT YEAR]
 *  times:
 *      instance: start time: 1pm, end time: 3pm
 *      instance: start time: 5pm, end time: 9pm
 *
 * Multiple
 */
class Recurrence
{
    /**
     * @var array $_dates Data structure containing all dates added
     */
    private $_dates = array();

    /**
     * @var bool $_parseTimes Boolean to determine whether this class
     *                        should attempt to parse time instances
     */
    private $_parseTimes = true;

    /**
     * @var bool $_excludePastDates Boolean to filter out all dates that have
     *                             already occurred
     */
    private $_excludePastDates = true;

    /**
     * Constructs a class instance and sets valid class parameters
     *
     * @param array $params Hash of parameters to set up in the class. Keys
     *                      are the class variable name.
     */
    public function __construct($params = array())
    {
        foreach ($params as $key => $value) {
            if (property_exists($this, ($a = "_$key")) || property_exists($this, ($a = $key))) {
                $this->$a = $value;
            }
        }
    }

    /**
     * Function to add dates to parse and ultimately consolidate with others
     *
     * @param $dates array Array of dates to parse. This can either be a date
     *                     string, timestamp, or an array containing a date
     *                     key with value and (optionally) a time key with value.
     */
    public function addDates($dates)
    {
        foreach ($dates as $dateString) {
            $timeString = '';

            if (is_array($dateString)) {
                $timeString = $dateString['time'];
                $dateString = $dateString['date'];
            }
            else if (is_numeric($dateString)) {
                $timeString = date("g:i a", $dateString);
                $dateString = date("F j, Y", $dateString);
            }

            list($date, $instances) = $this->parse($dateString, $timeString);

            /* @var $date DateTime */
            if (!$date) {
                trigger_error("Invalid date: $dateString");
                continue;
            }

            $key = $date->getTimestamp();

            if ($this->_excludePastDates) {
                if ($key < strtotime("today")) {
                    continue;
                }
            }

            if (isset($this->_dates[$key])) {
                foreach ($instances as $instance) {
                    $found = false;
                    foreach ($this->_dates[$key]['instances'] as $i) {
                        if ($i === $instance) {
                            $found = true;
                            break;
                        }
                    }
                    if (!$found) {
                        $this->_dates[$key]['instances'][] = $instance;
                    }
                }
            }
            else {
                $this->_dates[$key] = array(
                    'raw_date' => $dateString,
                    'raw_time' => $timeString,
                    'date'     => $date,
                    'instances' => $instances,
                );
            }
        }
    }

    public function getCompressedDates()
    {
        $retval = array();
        $dates = array_values($this->_dates);
        $counter = 0;
        foreach ($dates as $index => $date) {
            if ($counter > 0) {
                // Skip over the consecutive days we've found and accoutned for
                $counter--;
                continue;
            }

            $xary = array(
                'start_date' => $date['date'],
                'end_date'   => null,
                'times'      => $date['instances'],
            );

            do {
                if (!isset($dates[$index+$counter+1])) {
                    if ($counter > 0 && isset($nextDay)) {
                        $previousDay = $nextDay;
                    }
                    break;
                }

                $previousDay = $dates[$index+$counter];
                $nextDay = $dates[$index+$counter+1];

                if ($nextDay['date']->getTimestamp() - $previousDay['date']->getTimestamp() > 86400) {
                    break;
                }

                if ($previousDay['instances'] != $nextDay['instances']) {
                    break;
                }

                $counter++;
            } while ($nextDay['date']->getTimestamp() - $previousDay['date']->getTimestamp() === 86400);

            if ($counter > 0) {
                if ($counter === 1) {
                    $counter = 0;
                }
                else {
                    $xary['end_date'] = $previousDay['date'];
                }
            }

            $retval[] = $xary;
        }

        return $retval;
    }

    private function parse($dateString, $time = null)
    {
        $retval = array(
            $dateString, array()
        );

        $date = $dateString;

        if (is_numeric($date)) {
            try {
                $date = Date::createFromTimestamp($dateString);
            }
            catch (Exception $e) {
                // Unable to create DateTime object with dateString
                return $retval;
            }
        }

        if (!($date instanceof DateTime)) {
            $info = date_parse($dateString);

            // If no month or day is parsed, assume this is an invalid format
            if (!$info['month'] || !$info['day']) {
                return null;
            }

            if ($info['errors']) {
                $keys = array_keys($info['errors']);
                $offset = array_shift($keys);
                $date = substr($dateString, 0, $offset);

                if (!$time) {
                    $time = substr($dateString, $offset+1);
                }

                $info = date_parse($date);
                if ($info['errors']) {
                    return $retval;
                }

                try {
                    $date = new Date($date);
                }
                catch (Exception $e) {
                    // Unable to create DateTime object
                    return $retval;
                }
            }
            else {
                if (!$info['year']) {
                    $info['year'] = date('Y');
                }

                try {
                    $date = new Date("{$info['month']}/{$info['day']}/{$info['year']}");
                }
                catch (Exception $e) {
                    // Unable to create DateTime object
                    return $retval;
                }

                if (!$time) {
                    if ($info['hour'] === 0 && $info['minute'] === 0) {
                        $time = null;
                    }
                    else {
                        $time = "{$info['hour']}:{$info['minute']}";
                    }
                }
            }
        }
        else {
            if (!$time) {
                if ($date->format("g:ia") !== "12:00am") {
                    $time = $date->format("g:ia");
                }
            }
        }

        $instances = array();
        if ($this->_parseTimes) {
            $time = preg_replace(
                array(
                    '#\s+(?:(?:un)?\'?til{1,2}|thr(?:ough|u))\s+#i', // Replace 'until/til/till/thru/through' with '-' for easier parsing
                    '#\s(a|p)\.?m\.?#i', // Replace a.m./p.m. with am/pm
                    //                    '#\s+(at|@)\s+#i',
                    '#(\s|-)(noon)(\s|-|,|$)#i',
                    '#(\s|-)(midnight)(\s|-|,|$)#i',
                ), array(
                '-',
                '$1m',
                //                '',
                '${1}12:00pm$3',
                '${1}12:00am$3',
            ), $time
            );

            if (preg_match_all('#((?:.|\s)*?)(\d{1,2}(?:\:\d{2})?\s*(?:(?:a|p)m)?(?:-|$|,|\s+and\s+|\s+))#i', $time, $matches)) {
                $skip = 0;
                foreach ($matches[2] as $index => $match) {
                    if ($skip > 0) {
                        $skip--;
                        continue;
                    }

                    $instance = new Instance($time);
                    if (preg_match('#\A(.+?),\s*$#', $match, $found)) {
                        $instance->setStartTime(new Time($found[1]));
                    }
                    else if (preg_match('#\A(.+?)-$#', $match, $found)) {
                        $skip++;
                        $instance->setStartTime(new Time($found[1]));
                        $instance->setEndTime(new Time($matches[0][$index+1]));
                    }
                    else {
                        $instance->setStartTime(new Time($match));
                    }
                    if ($matches[1][$index]) {
                        /* @var $instance Instance */
                        $instance->setStartDescription($matches[1][$index]);
                        if ($instance->getEndTime()) {
                            $instance->setEndDescription($matches[1][$index+1]);
                        }
                    }

                    $instances[] = $instance;
                }
            }
            else {
                // throw error?
            }
        }
        else {
            $instances[] = new Instance($time);
        }

        return array(
            $date, $instances
        );
    }

    public function getFormattedCompressedDates($dateFormat = "D, M j", $dateSeparator = " thru ", $dateTimeSeparator = ' at ')
    {
        $compressedDates = $this->getCompressedDates();

        $retval = array();
        foreach ($compressedDates as $date) {
            $formattedString = date($dateFormat, $date['start_date']->getTimestamp());
            if ($date['end_date']) {
                $formattedString .= $dateSeparator . date($dateFormat, $date['end_date']->getTimestamp());
            }

            foreach ($date['times'] as &$instance) {
                $instance = $instance->toString();
            }

            if ($time = trim(implode(', ', $date['times']), ', ')) {
                $formattedString .= $dateTimeSeparator . $time;
            }

            $retval[] = $formattedString;
        }

        return $retval;
    }
}