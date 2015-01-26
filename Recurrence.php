<?php
/**
 * @author Alex Phillips <aphillips@cbcnewmedia.com>
 * Date: 1/26/15
 * Time: 11:19 AM
 */

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
     * @var string $_timeFormat PHP date format string to format all
     *                          times
     */
    private $_timeFormat = "g:ia";

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

            list($date, $instances) = $this->parse($dateString, $timeString);

            /* @var $date DateTime */
            if (!$date) {
                trigger_error("Invalid date: $dateString");
                continue;
            }

            $key = $date->getTimestamp();
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
                try {
                    $this->_dates[$key] = array(
                        'raw_date' => $dateString,
                        'raw_time' => $timeString,
                        'date'     => $date,
                        'instances' => $instances,
                    );
                }
                catch (Exception $e) {
                    // Unable to parse $date into DateTime object
                }
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
                $date = new DateTime();
                $date->setTimestamp($dateString);
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
                    $date = new DateTime($date);
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
                    $date = new DateTime("{$info['month']}/{$info['day']}/{$info['year']}");
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
                    '#\s+(?:(?:un)?\'?til{1,2}|thr(?:ough|u)|to)\s+#i', // Replace 'until/til/till/thru/through' with '-' for easier parsing
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

            if (preg_match('#happy#i', $time)) {
                $test = 1;
            }

            if (preg_match_all('#((?:.|\s)*?)(\d{1,2}(?:\:\d{2})?\s*(?:(?:a|p)m)?(?:-|$|,|\s+and\s+|\s+))#i', $time, $matches)) {
                $skip = 0;
                foreach ($matches[2] as $index => $match) {
                    if ($skip > 0) {
                        $skip--;
                        continue;
                    }

                    $instance = array(
                        'start' => null,
                        'end'   => null,
                    );
                    if (preg_match('#\A(.+?),\s*$#', $match, $found)) {
                        $found[1] = trim($found[1], " \t\n\r\0\x0B,-");
                        $found[1] = preg_replace('#\s+and(?:\s+|$)#', '', $found[1]);

                        $instance['start'] = $found[1];
                    }
                    else if (preg_match('#\A(.+?)-$#', $match, $found)) {
                        $skip++;

                        $found[1] = trim($found[1], " \t\n\r\0\x0B,-");
                        $found[1] = preg_replace('#\s+and(?:\s+|$)#', '', $found[1]);
                        $instance['start'] = $found[1];


                        $end = trim($matches[0][$index+1], " \t\n\r\0\x0B,-");
                        $end = preg_replace('#\s+and(?:\s+|$)#', '', $end);
                        $instance['end'] = $end;
                    }
                    else {
                        $match = trim($match, " \t\n\r\0\x0B,-");
                        $match = preg_replace('#\s+and(?:\s+|$)#', '', $match);

                        $instance['start'] = $match;
                    }

                    $instance = $this->formatInstance($instance);
                    $instance['start'] = trim(trim($matches[1][$index]) . " " . $instance['start']);
                    if ($instance['end']) {
                        $instance['end'] = trim(trim($matches[1][$index+1]) . " " . $instance['end']);
                    }

                    $instances[] = $instance;
                }
            }
        }
        else {
            $instances[] = array(
                'start' => $time,
                'end'   => null,
            );
        }

        return array(
            $date, $instances
        );
    }

    private function formatInstance($instance)
    {
        // Finish time string if only hour given
        if (is_numeric($instance['start'])) {
            $instance['start'] = $instance['start'] . ":00";
        }
        if (is_numeric($instance['end'])) {
            $instance['end'] = $instance['end'] . ":00";
        }

        // Handle military time
        foreach ($instance as $k => &$v) {
            if ($v) {
                if (!preg_match('#(?:a|p)m#', $v)) {
                    list($hour, $minutes) = explode(':', $v);
                    if ($hour > 12) {
                        $hour = $hour - 12;
                        $v = "{$hour}:{$minutes}pm";
                    }
                }
            }
        }

        // Make assumptions about am/pm if not available
        if ($instance['start'] && $instance['end']) {
            if (!preg_match('#(?:a|p)m#', $instance['start']) && !preg_match('#(?:a|p)m#', $instance['end'])) {
                if (strtotime($instance['start']) > strtotime($instance['end'])) {
                    $instance['start'] .= "am";
                    $instance['end'] .= "pm";
                }
            }
        }

        foreach ($instance as $k => &$v) {
            if ($v) {
                $info = date_parse($v);
                if (!$info['errors']) {
                    $v = $this->formatTime($v);
                }
            }
        }

        return $instance;
    }

    private function formatTime($time)
    {
        $format = $this->_timeFormat;
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
                $instance = trim(implode('-', $instance), '-');
            }

            if ($time = trim(implode(', ', $date['times']), ', ')) {
                $formattedString .= $dateTimeSeparator . $time;
            }

            $retval[] = $formattedString;
        }

        return $retval;
    }
}