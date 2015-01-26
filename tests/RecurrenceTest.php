<?php

/**
 * @author Alex Phillips <aphillips@cbcnewmedia.com>
 * Date: 1/26/15
 * Time: 9:25 AM
 */
class RecurrenceTest extends PHPUnit_Framework_TestCase
{
    public function testRecurrence()
    {
        $this->assertEquals($this->generateFormatted([
            "Mon, Jan 26: 12:00am",
            "Tue, Jan 27: 12:00am",
            "Wed, Jan 28: 12:00am",
            "Thu, Jan 29: 12:00am",
            "Fri, Jan 30: 12:00am",
        ]), [
            "Mon, Jan 26 thru Fri, Jan 30 at 12am"
        ]);

        $this->assertEquals($this->generateFormatted([
            "Tue, Jan 27: 9-7",
            "Wed, Jan 28: 9-7",
            "Thu, Jan 29: 9-7",
            "Fri, Jan 30: 9-7",
            "Sat, Jan 31: 9-7",
            "Sun, Feb 1: 9-7",
            "Tue, Feb 3: 9-7",
            "Wed, Feb 4: 9-7",
            "Thu, Feb 5: 9-7",
            "Fri, Feb 6: 9-7",
            "Sat, Feb 7: 9-7",
            "Sun, Feb 8: 9-7",
            "Tue, Feb 10: 9-7",
            "Wed, Feb 11: 9-7",
            "Thu, Feb 12: 9-7",
            "Fri, Feb 13: 9-7",
            "Sat, Feb 14: 9-7",
            "Sun, Feb 15: 9-7",
            "Tue, Feb 17: 9-7",
            "Wed, Feb 18: 9-7",
            "Thu, Feb 19: 9-7",
            "Fri, Feb 20: 9-7",
            "Sat, Feb 21: 9-7",
            "Sun, Feb 22: 9-7",
            "Tue, Feb 24: 9-7",
            "Wed, Feb 25: 9-7",
            "Thu, Feb 26: 9-7",
            "Fri, Feb 27: 9-7",
            "Sat, Feb 28: 9-7",
            "Sun, Mar 1: 9-7",
            "Tue, Mar 3: 9-7",
            "Wed, Mar 4: 9-7",
            "Thu, Mar 5: 9-7",
            "Fri, Mar 6: 9-7",
            "Sat, Mar 7: 9-7",
            "Sun, Mar 8: 9-7",
        ]), [
            "Tue, Jan 27 thru Sun, Feb 1 at 9am-7pm",
            "Tue, Feb 3 thru Sun, Feb 8 at 9am-7pm",
            "Tue, Feb 10 thru Sun, Feb 15 at 9am-7pm",
            "Tue, Feb 17 thru Sun, Feb 22 at 9am-7pm",
            "Tue, Feb 24 thru Sun, Mar 1 at 9am-7pm",
            "Tue, Mar 3 thru Sun, Mar 8 at 9am-7pm",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Tue, Jan 27: 10 a.m. till 5 p.m.",
            "Wed, Jan 28: 10 a.m. till 5 p.m.",
            "Thu, Jan 29: 10 a.m. till 5 p.m.",
            "Fri, Jan 30: 10 a.m. till 9 p.m.",
            "Sat, Jan 31: 10 a.m. till 5 p.m.",
            "Sun, Feb 1: 10 a.m. till 5 p.m.",
            "Tue, Feb 3: 10 a.m. till 5 p.m.",
            "Wed, Feb 4: 10 a.m. till 5 p.m.",
            "Thu, Feb 5: 10 a.m. till 5 p.m.",
            "Fri, Feb 6: 10 a.m. till 9 p.m.",
            "Sat, Feb 7: 10 a.m. till 5 p.m.",
            "Sun, Feb 8: 10 a.m. till 5 p.m.",
            "Tue, Feb 10: 10 a.m. till 5 p.m.",
            "Wed, Feb 11: 10 a.m. till 5 p.m.",
            "Thu, Feb 12: 10 a.m. till 5 p.m.",
            "Fri, Feb 13: 10 a.m. till 9 p.m.",
            "Sat, Feb 14: 10 a.m. till 5 p.m.",
            "Sun, Feb 15: 10 a.m. till 5 p.m.",
            "Tue, Feb 17: 10 a.m. till 5 p.m.",
            "Wed, Feb 18: 10 a.m. till 5 p.m.",
            "Thu, Feb 19: 10 a.m. till 5 p.m.",
            "Fri, Feb 20: 10 a.m. till 9 p.m.",
            "Sat, Feb 21: 10 a.m. till 5 p.m.",
            "Sun, Feb 22: 10 a.m. till 5 p.m.",
            "Tue, Feb 24: 10 a.m. till 5 p.m.",
            "Wed, Feb 25: 10 a.m. till 5 p.m.",
            "Thu, Feb 26: 10 a.m. till 5 p.m.",
            "Fri, Feb 27: 10 a.m. till 9 p.m.",
            "Sat, Feb 28: 10 a.m. till 5 p.m.",
            "Sun, Mar 1: 10 a.m. till 5 p.m.",
            "Tue, Mar 3: 10 a.m. till 5 p.m.",
            "Wed, Mar 4: 10 a.m. till 5 p.m.",
            "Thu, Mar 5: 10 a.m. till 5 p.m.",
            "Fri, Mar 6: 10 a.m. till 9 p.m.",
            "Sat, Mar 7: 10 a.m. till 5 p.m.",
            "Sun, Mar 8: 10 a.m. till 5 p.m.",
            "Tue, Mar 10: 10 a.m. till 5 p.m.",
            "Wed, Mar 11: 10 a.m. till 5 p.m.",
            "Thu, Mar 12: 10 a.m. till 5 p.m.",
            "Fri, Mar 13: 10 a.m. till 9 p.m.",
            "Sat, Mar 14: 10 a.m. till 5 p.m.",
            "Sun, Mar 15: 10 a.m. till 5 p.m.",
            "Tue, Mar 17: 10 a.m. till 5 p.m.",
            "Wed, Mar 18: 10 a.m. till 5 p.m.",
            "Thu, Mar 19: 10 a.m. till 5 p.m.",
            "Fri, Mar 20: 10 a.m. till 9 p.m.",
            "Sat, Mar 21: 10 a.m. till 5 p.m.",
            "Sun, Mar 22: 10 a.m. till 5 p.m.",
            "Tue, Mar 24: 10 a.m. till 5 p.m.",
            "Wed, Mar 25: 10 a.m. till 5 p.m.",
            "Thu, Mar 26: 10 a.m. till 5 p.m.",
            "Fri, Mar 27: 10 a.m. till 9 p.m.",
            "Sat, Mar 28: 10 a.m. till 5 p.m.",
            "Sun, Mar 29: 10 a.m. till 5 p.m.",
            "Tue, Mar 31: 10 a.m. till 5 p.m.",
            "Wed, Apr 1: 10 a.m. till 5 p.m.",
            "Thu, Apr 2: 10 a.m. till 5 p.m.",
            "Fri, Apr 3: 10 a.m. till 9 p.m.",
            "Sat, Apr 4: 10 a.m. till 5 p.m.",
            "Sun, Apr 5: 10 a.m. till 5 p.m.",
            "Tue, Apr 7: 10 a.m. till 5 p.m.",
            "Wed, Apr 8: 10 a.m. till 5 p.m.",
            "Thu, Apr 9: 10 a.m. till 5 p.m.",
            "Fri, Apr 10: 10 a.m. till 9 p.m.",
            "Sat, Apr 11: 10 a.m. till 5 p.m.",
            "Sun, Apr 12: 10 a.m. till 5 p.m.",
        ]), [
            "Tue, Jan 27 thru Thu, Jan 29 at 10am-5pm",
            "Fri, Jan 30 at 10am-9pm",
            "Sat, Jan 31 at 10am-5pm",
            "Sun, Feb 1 at 10am-5pm",
            "Tue, Feb 3 thru Thu, Feb 5 at 10am-5pm",
            "Fri, Feb 6 at 10am-9pm",
            "Sat, Feb 7 at 10am-5pm",
            "Sun, Feb 8 at 10am-5pm",
            "Tue, Feb 10 thru Thu, Feb 12 at 10am-5pm",
            "Fri, Feb 13 at 10am-9pm",
            "Sat, Feb 14 at 10am-5pm",
            "Sun, Feb 15 at 10am-5pm",
            "Tue, Feb 17 thru Thu, Feb 19 at 10am-5pm",
            "Fri, Feb 20 at 10am-9pm",
            "Sat, Feb 21 at 10am-5pm",
            "Sun, Feb 22 at 10am-5pm",
            "Tue, Feb 24 thru Thu, Feb 26 at 10am-5pm",
            "Fri, Feb 27 at 10am-9pm",
            "Sat, Feb 28 at 10am-5pm",
            "Sun, Mar 1 at 10am-5pm",
            "Tue, Mar 3 thru Thu, Mar 5 at 10am-5pm",
            "Fri, Mar 6 at 10am-9pm",
            "Sat, Mar 7 at 10am-5pm",
            "Sun, Mar 8 at 10am-5pm",
            "Tue, Mar 10 thru Thu, Mar 12 at 10am-5pm",
            "Fri, Mar 13 at 10am-9pm",
            "Sat, Mar 14 at 10am-5pm",
            "Sun, Mar 15 at 10am-5pm",
            "Tue, Mar 17 thru Thu, Mar 19 at 10am-5pm",
            "Fri, Mar 20 at 10am-9pm",
            "Sat, Mar 21 at 10am-5pm",
            "Sun, Mar 22 at 10am-5pm",
            "Tue, Mar 24 thru Thu, Mar 26 at 10am-5pm",
            "Fri, Mar 27 at 10am-9pm",
            "Sat, Mar 28 at 10am-5pm",
            "Sun, Mar 29 at 10am-5pm",
            "Tue, Mar 31 thru Thu, Apr 2 at 10am-5pm",
            "Fri, Apr 3 at 10am-9pm",
            "Sat, Apr 4 at 10am-5pm",
            "Sun, Apr 5 at 10am-5pm",
            "Tue, Apr 7 thru Thu, Apr 9 at 10am-5pm",
            "Fri, Apr 10 at 10am-9pm",
            "Sat, Apr 11 at 10am-5pm",
            "Sun, Apr 12 at 10am-5pm",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Tue, Jan 27: 10 a.m. till 5 p.m.",
            "Wed, Jan 28: 10 a.m. till 5 p.m.",
            "Thu, Jan 29: 10 a.m. till 5 p.m.",
            "Fri, Jan 30: 10 a.m. till 9 p.m.",
            "Sat, Jan 31: 10 a.m. till 5 p.m.",
            "Sun, Feb 1: 10 a.m. till 5 p.m.",
            "Tue, Feb 3: 10 a.m. till 5 p.m.",
            "Wed, Feb 4: 10 a.m. till 5 p.m.",
            "Thu, Feb 5: 10 a.m. till 5 p.m.",
            "Fri, Feb 6: 10 a.m. till 9 p.m.",
            "Sat, Feb 7: 10 a.m. till 5 p.m.",
            "Sun, Feb 8: 10 a.m. till 5 p.m.",
            "Tue, Feb 10: 10 a.m. till 5 p.m.",
            "Wed, Feb 11: 10 a.m. till 5 p.m.",
            "Thu, Feb 12: 10 a.m. till 5 p.m.",
            "Fri, Feb 13: 10 a.m. till 9 p.m.",
            "Sat, Feb 14: 10 a.m. till 5 p.m.",
            "Sun, Feb 15: 10 a.m. till 5 p.m.",
            "Tue, Feb 17: 10 a.m. till 5 p.m.",
            "Wed, Feb 18: 10 a.m. till 5 p.m.",
            "Thu, Feb 19: 10 a.m. till 5 p.m.",
            "Fri, Feb 20: 10 a.m. till 9 p.m.",
            "Sat, Feb 21: 10 a.m. till 5 p.m.",
            "Sun, Feb 22: 10 a.m. till 5 p.m.",
            "Tue, Feb 24: 10 a.m. till 5 p.m.",
            "Wed, Feb 25: 10 a.m. till 5 p.m.",
            "Thu, Feb 26: 10 a.m. till 5 p.m.",
            "Fri, Feb 27: 10 a.m. till 9 p.m.",
            "Sat, Feb 28: 10 a.m. till 5 p.m.",
            "Sun, Mar 1: 10 a.m. till 5 p.m.",
            "Tue, Mar 3: 10 a.m. till 5 p.m.",
            "Wed, Mar 4: 10 a.m. till 5 p.m.",
            "Thu, Mar 5: 10 a.m. till 5 p.m.",
            "Fri, Mar 6: 10 a.m. till 9 p.m.",
            "Sat, Mar 7: 10 a.m. till 5 p.m.",
            "Sun, Mar 8: 10 a.m. till 5 p.m.",
            "Tue, Mar 10: 10 a.m. till 5 p.m.",
            "Wed, Mar 11: 10 a.m. till 5 p.m.",
            "Thu, Mar 12: 10 a.m. till 5 p.m.",
            "Fri, Mar 13: 10 a.m. till 9 p.m.",
            "Sat, Mar 14: 10 a.m. till 5 p.m.",
            "Sun, Mar 15: 10 a.m. till 5 p.m.",
            "Tue, Mar 17: 10 a.m. till 5 p.m.",
            "Wed, Mar 18: 10 a.m. till 5 p.m.",
            "Thu, Mar 19: 10 a.m. till 5 p.m.",
            "Fri, Mar 20: 10 a.m. till 9 p.m.",
            "Sat, Mar 21: 10 a.m. till 5 p.m.",
            "Sun, Mar 22: 10 a.m. till 5 p.m.",
        ]), [
            "Tue, Jan 27 thru Thu, Jan 29 at 10am-5pm",
            "Fri, Jan 30 at 10am-9pm",
            "Sat, Jan 31 at 10am-5pm",
            "Sun, Feb 1 at 10am-5pm",
            "Tue, Feb 3 thru Thu, Feb 5 at 10am-5pm",
            "Fri, Feb 6 at 10am-9pm",
            "Sat, Feb 7 at 10am-5pm",
            "Sun, Feb 8 at 10am-5pm",
            "Tue, Feb 10 thru Thu, Feb 12 at 10am-5pm",
            "Fri, Feb 13 at 10am-9pm",
            "Sat, Feb 14 at 10am-5pm",
            "Sun, Feb 15 at 10am-5pm",
            "Tue, Feb 17 thru Thu, Feb 19 at 10am-5pm",
            "Fri, Feb 20 at 10am-9pm",
            "Sat, Feb 21 at 10am-5pm",
            "Sun, Feb 22 at 10am-5pm",
            "Tue, Feb 24 thru Thu, Feb 26 at 10am-5pm",
            "Fri, Feb 27 at 10am-9pm",
            "Sat, Feb 28 at 10am-5pm",
            "Sun, Mar 1 at 10am-5pm",
            "Tue, Mar 3 thru Thu, Mar 5 at 10am-5pm",
            "Fri, Mar 6 at 10am-9pm",
            "Sat, Mar 7 at 10am-5pm",
            "Sun, Mar 8 at 10am-5pm",
            "Tue, Mar 10 thru Thu, Mar 12 at 10am-5pm",
            "Fri, Mar 13 at 10am-9pm",
            "Sat, Mar 14 at 10am-5pm",
            "Sun, Mar 15 at 10am-5pm",
            "Tue, Mar 17 thru Thu, Mar 19 at 10am-5pm",
            "Fri, Mar 20 at 10am-9pm",
            "Sat, Mar 21 at 10am-5pm",
            "Sun, Mar 22 at 10am-5pm",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Fri, Jan 30:",
            "Fri, Feb 20: 11:00am",
        ]), [
            "Fri, Jan 30",
            "Fri, Feb 20 at 11am",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Sun, Feb 1: 11:30 a.m. and 1:30 p.m.",
            "Tue, Feb 3: 11:30 a.m. and 1:30 p.m.",
            "Wed, Feb 4: 11:30 a.m. and 1:30 p.m.",
            "Thu, Feb 5: 11:30 a.m. and 1:30 p.m.",
            "Fri, Feb 6: 11:30 a.m. and 1:30 p.m.",
            "Sat, Feb 7: 11:30 a.m. and 1:30 p.m.",
            "Sun, Feb 8: 11:30 a.m. and 1:30 p.m.",
            "Tue, Feb 10: 1:30pm",
            "Wed, Feb 11: 1:30pm",
            "Thu, Feb 12: 1:30pm",
            "Fri, Feb 13: 1:30pm",
            "Sat, Feb 14: 11:30am and 1:30pm",
            "Sun, Feb 15: 11:30am and 1:30pm",
            "Tue, Feb 17: 1:30pm",
            "Wed, Feb 18: 1:30pm",
            "Thu, Feb 19: 1:30pm",
            "Fri, Feb 20: 1:30pm",
            "Sat, Feb 21: 11:30am and 1:30pm",
            "Sun, Feb 22: 11:30am and 1:30pm",
            "Tue, Feb 24: 1:30pm",
            "Wed, Feb 25: 1:30pm",
            "Thu, Feb 26: 1:30pm",
            "Fri, Feb 27: 1:30pm",
            "Sat, Feb 28: 11:30am and 1:30pm",
        ]), [
            "Sun, Feb 1 at 11:30am, 1:30pm",
            "Tue, Feb 3 thru Sun, Feb 8 at 11:30am, 1:30pm",
            "Tue, Feb 10 thru Fri, Feb 13 at 1:30pm",
            "Sat, Feb 14 at 11:30am, 1:30pm",
            "Sun, Feb 15 at 11:30am, 1:30pm",
            "Tue, Feb 17 thru Fri, Feb 20 at 1:30pm",
            "Sat, Feb 21 at 11:30am, 1:30pm",
            "Sun, Feb 22 at 11:30am, 1:30pm",
            "Tue, Feb 24 thru Fri, Feb 27 at 1:30pm",
            "Sat, Feb 28 at 11:30am, 1:30pm",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Sun, Feb 1: 12:30pm and 2:30pm",
            "Sat, Feb 7: 12:30pm and 2:30pm",
            "Sun, Feb 8: 12:30pm and 2:30pm",
            "Sat, Feb 14: 12:30pm and 2:30pm",
            "Sun, Feb 15: 12:30pm and 2:30pm",
            "Sat, Feb 21: 12:30pm and 2:30pm",
            "Sun, Feb 22: 12:30pm and 2:30pm",
            "Sat, Feb 28: 12:30pm and 2:30pm",
        ]), [
            "Sun, Feb 1 at 12:30pm, 2:30pm",
            "Sat, Feb 7 at 12:30pm, 2:30pm",
            "Sun, Feb 8 at 12:30pm, 2:30pm",
            "Sat, Feb 14 at 12:30pm, 2:30pm",
            "Sun, Feb 15 at 12:30pm, 2:30pm",
            "Sat, Feb 21 at 12:30pm, 2:30pm",
            "Sun, Feb 22 at 12:30pm, 2:30pm",
            "Sat, Feb 28 at 12:30pm, 2:30pm",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Fri, Feb 6: 8pm",
        ]), [
            "Fri, Feb 6 at 8pm",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Fri, Feb 6: 6pm and 7pm",
            "Fri, Feb 13: 6pm and 7pm",
            "Fri, Feb 20: 6pm and 7pm",
            "Fri, Feb 27: 6pm and 7pm",
        ]), [
            "Fri, Feb 6 at 6pm, 7pm",
            "Fri, Feb 13 at 6pm, 7pm",
            "Fri, Feb 20 at 6pm, 7pm",
            "Fri, Feb 27 at 6pm, 7pm",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Fri, Feb 6: 5:30 - 8:30",
            "Fri, Feb 13: 5:30 - 8:30",
            "Fri, Feb 20: 5:30 - 8:30",
            "Fri, Feb 27: 5:30 - 8:30",
        ]), [
            "Fri, Feb 6 at 5:30-8:30",
            "Fri, Feb 13 at 5:30-8:30",
            "Fri, Feb 20 at 5:30-8:30",
            "Fri, Feb 27 at 5:30-8:30",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Sun, Feb 8: 3:00pm",
        ]), [
            "Sun, Feb 8 at 3pm",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Sun, Feb 8: ",
        ]), [
            "Sun, Feb 8",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Thu, Feb 12: 7:00pm",
        ]), [
            "Thu, Feb 12 at 7pm",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Fri, Feb 13: 8pm",
        ]), [
            "Fri, Feb 13 at 8pm",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Sat, Feb 14: 5 p.m.",
        ]), [
            "Sat, Feb 14 at 5pm",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Sat, Feb 14: 5 - 10",
        ]), [
            "Sat, Feb 14 at 5-10",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Fri, Feb 20: 11 a.m.",
        ]), [
            "Fri, Feb 20 at 11am",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Fri, Feb 20: 8pm",
        ]), [
            "Fri, Feb 20 at 8pm",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Mon, Feb 23: ",
        ]), [
            "Mon, Feb 23",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Fri, Feb 27: 8pm",
        ]), [
            "Fri, Feb 27 at 8pm",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Sat, Feb 28: 7 and 9:30 p.m.",
        ]), [
            "Sat, Feb 28 at 7, 9:30pm",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Sat, Feb 28: 7pm",
        ]), [
            "Sat, Feb 28 at 7pm",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Sat, Feb 28: 9:30-midnight",
        ]), [
            "Sat, Feb 28 at 9:30-12am",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Sat, Mar 7: 10 a.m. till 5 p.m.",
            "Sun, Mar 8: 10 a.m. till 5 p.m.",
            "Tue, Mar 10: 10 a.m. till 5 p.m.",
            "Wed, Mar 11: 10 a.m. till 5 p.m.",
            "Thu, Mar 12: 10 a.m. till 5 p.m.",
            "Fri, Mar 13: 10 a.m. till 9 p.m.",
            "Sat, Mar 14: 10 a.m. till 5 p.m.",
            "Sun, Mar 15: 10 a.m. till 5 p.m.",
            "Tue, Mar 17: 10 a.m. till 5 p.m.",
            "Wed, Mar 18: 10 a.m. till 5 p.m.",
            "Thu, Mar 19: 10 a.m. till 5 p.m.",
            "Fri, Mar 20: 10 a.m. till 9 p.m.",
            "Sat, Mar 21: 10 a.m. till 5 p.m.",
            "Sun, Mar 22: 10 a.m. till 5 p.m.",
            "Tue, Mar 24: 10 a.m. till 5 p.m.",
            "Wed, Mar 25: 10 a.m. till 5 p.m.",
            "Thu, Mar 26: 10 a.m. till 5 p.m.",
            "Fri, Mar 27: 10 a.m. till 9 p.m.",
            "Sat, Mar 28: 10 a.m. till 5 p.m.",
            "Sun, Mar 29: 10 a.m. till 5 p.m.",
            "Tue, Mar 31: 10 a.m. till 5 p.m.",
            "Wed, Apr 1: 10 a.m. till 5 p.m.",
            "Thu, Apr 2: 10 a.m. till 5 p.m.",
            "Fri, Apr 3: 10 a.m. till 9 p.m.",
            "Sat, Apr 4: 10 a.m. till 5 p.m.",
            "Sun, Apr 5: 10 a.m. till 5 p.m.",
            "Tue, Apr 7: 10 a.m. till 5 p.m.",
            "Wed, Apr 8: 10 a.m. till 5 p.m.",
            "Thu, Apr 9: 10 a.m. till 5 p.m.",
            "Fri, Apr 10: 10 a.m. till 9 p.m.",
            "Sat, Apr 11: 10 a.m. till 5 p.m.",
            "Sun, Apr 12: 10 a.m. till 5 p.m.",
            "Tue, Apr 14: 10 a.m. till 5 p.m.",
            "Wed, Apr 15: 10 a.m. till 5 p.m.",
            "Thu, Apr 16: 10 a.m. till 5 p.m.",
            "Fri, Apr 17: 10 a.m. till 9 p.m.",
            "Sat, Apr 18: 10 a.m. till 5 p.m.",
            "Sun, Apr 19: 10 a.m. till 5 p.m.",
            "Tue, Apr 21: 10 a.m. till 5 p.m.",
            "Wed, Apr 22: 10 a.m. till 5 p.m.",
            "Thu, Apr 23: 10 a.m. till 5 p.m.",
            "Fri, Apr 24: 10 a.m. till 9 p.m.",
            "Sat, Apr 25: 10 a.m. till 5 p.m.",
            "Sun, Apr 26: 10 a.m. till 5 p.m.",
            "Tue, Apr 28: 10 a.m. till 5 p.m.",
            "Wed, Apr 29: 10 a.m. till 5 p.m.",
            "Thu, Apr 30: 10 a.m. till 5 p.m.",
            "Fri, May 1: 10 a.m. till 9 p.m.",
            "Sat, May 2: 10 a.m. till 5 p.m.",
            "Sun, May 3: 10 a.m. till 5 p.m.",
            "Tue, May 5: 10 a.m. till 5 p.m.",
            "Wed, May 6: 10 a.m. till 5 p.m.",
            "Thu, May 7: 10 a.m. till 5 p.m.",
            "Fri, May 8: 10 a.m. till 9 p.m.",
            "Sat, May 9: 10 a.m. till 5 p.m.",
            "Sun, May 10: 10 a.m. till 5 p.m.",
            "Tue, May 12: 10 a.m. till 5 p.m.",
            "Wed, May 13: 10 a.m. till 5 p.m.",
            "Thu, May 14: 10 a.m. till 5 p.m.",
            "Fri, May 15: 10 a.m. till 9 p.m.",
            "Sat, May 16: 10 a.m. till 5 p.m.",
            "Sun, May 17: 10 a.m. till 5 p.m.",
            "Tue, May 19: 10 a.m. till 5 p.m.",
            "Wed, May 20: 10 a.m. till 5 p.m.",
            "Thu, May 21: 10 a.m. till 5 p.m.",
            "Fri, May 22: 10 a.m. till 9 p.m.",
            "Sat, May 23: 10 a.m. till 5 p.m.",
            "Sun, May 24: 10 a.m. till 5 p.m.",
            "Tue, May 26: 10 a.m. till 5 p.m.",
            "Wed, May 27: 10 a.m. till 5 p.m.",
            "Thu, May 28: 10 a.m. till 5 p.m.",
            "Fri, May 29: 10 a.m. till 9 p.m.",
            "Sat, May 30: 10 a.m. till 5 p.m.",
            "Sun, May 31: 10 a.m. till 5 p.m.",
            "Tue, Jun 2: 10 a.m. till 5 p.m.",
            "Wed, Jun 3: 10 a.m. till 5 p.m.",
            "Thu, Jun 4: 10 a.m. till 5 p.m.",
            "Fri, Jun 5: 10 a.m. till 9 p.m.",
            "Sat, Jun 6: 10 a.m. till 5 p.m.",
            "Sun, Jun 7: 10 a.m. till 5 p.m.",
            "Tue, Jun 9: 10 a.m. till 5 p.m.",
            "Wed, Jun 10: 10 a.m. till 5 p.m.",
            "Thu, Jun 11: 10 a.m. till 5 p.m.",
            "Fri, Jun 12: 10 a.m. till 9 p.m.",
            "Sat, Jun 13: 10 a.m. till 5 p.m.",
            "Sun, Jun 14: 10 a.m. till 5 p.m.",
            "Tue, Jun 16: 10 a.m. till 5 p.m.",
            "Wed, Jun 17: 10 a.m. till 5 p.m.",
            "Thu, Jun 18: 10 a.m. till 5 p.m.",
            "Fri, Jun 19: 10 a.m. till 9 p.m.",
            "Sat, Jun 20: 10 a.m. till 5 p.m.",
            "Sun, Jun 21: 10 a.m. till 5 p.m.",
            "Tue, Jun 23: 10 a.m. till 5 p.m.",
            "Wed, Jun 24: 10 a.m. till 5 p.m.",
            "Thu, Jun 25: 10 a.m. till 5 p.m.",
            "Fri, Jun 26: 10 a.m. till 9 p.m.",
            "Sat, Jun 27: 10 a.m. till 5 p.m.",
            "Sun, Jun 28: 10 a.m. till 5 p.m.",
            "Tue, Jun 30: 10 a.m. till 5 p.m.",
            "Wed, Jul 1: 10 a.m. till 5 p.m.",
            "Thu, Jul 2: 10 a.m. till 5 p.m.",
            "Fri, Jul 3: 10 a.m. till 9 p.m.",
            "Sat, Jul 4: 10 a.m. till 5 p.m.",
            "Sun, Jul 5: 10 a.m. till 5 p.m.",
            "Tue, Jul 7: 10 a.m. till 5 p.m.",
            "Wed, Jul 8: 10 a.m. till 5 p.m.",
            "Thu, Jul 9: 10 a.m. till 5 p.m.",
            "Fri, Jul 10: 10 a.m. till 9 p.m.",
            "Sat, Jul 11: 10 a.m. till 5 p.m.",
            "Sun, Jul 12: 10 a.m. till 5 p.m.",
            "Tue, Jul 14: 10 a.m. till 5 p.m.",
            "Wed, Jul 15: 10 a.m. till 5 p.m.",
            "Thu, Jul 16: 10 a.m. till 5 p.m.",
            "Fri, Jul 17: 10 a.m. till 9 p.m.",
            "Sat, Jul 18: 10 a.m. till 5 p.m.",
            "Sun, Jul 19: 10 a.m. till 5 p.m.",
            "Tue, Jul 21: 10 a.m. till 5 p.m.",
            "Wed, Jul 22: 10 a.m. till 5 p.m.",
            "Thu, Jul 23: 10 a.m. till 5 p.m.",
            "Fri, Jul 24: 10 a.m. till 9 p.m.",
            "Sat, Jul 25: 10 a.m. till 5 p.m.",
            "Sun, Jul 26: 10 a.m. till 5 p.m.",
            "Tue, Jul 28: 10 a.m. till 5 p.m.",
            "Wed, Jul 29: 10 a.m. till 5 p.m.",
            "Thu, Jul 30: 10 a.m. till 5 p.m.",
            "Fri, Jul 31: 10 a.m. till 9 p.m.",
            "Sat, Aug 1: 10 a.m. till 5 p.m.",
            "Sun, Aug 2: 10 a.m. till 5 p.m.",
        ]), [
            "Sat, Mar 7 at 10am-5pm",
            "Sun, Mar 8 at 10am-5pm",
            "Tue, Mar 10 thru Thu, Mar 12 at 10am-5pm",
            "Fri, Mar 13 at 10am-9pm",
            "Sat, Mar 14 at 10am-5pm",
            "Sun, Mar 15 at 10am-5pm",
            "Tue, Mar 17 thru Thu, Mar 19 at 10am-5pm",
            "Fri, Mar 20 at 10am-9pm",
            "Sat, Mar 21 at 10am-5pm",
            "Sun, Mar 22 at 10am-5pm",
            "Tue, Mar 24 thru Thu, Mar 26 at 10am-5pm",
            "Fri, Mar 27 at 10am-9pm",
            "Sat, Mar 28 at 10am-5pm",
            "Sun, Mar 29 at 10am-5pm",
            "Tue, Mar 31 thru Thu, Apr 2 at 10am-5pm",
            "Fri, Apr 3 at 10am-9pm",
            "Sat, Apr 4 at 10am-5pm",
            "Sun, Apr 5 at 10am-5pm",
            "Tue, Apr 7 thru Thu, Apr 9 at 10am-5pm",
            "Fri, Apr 10 at 10am-9pm",
            "Sat, Apr 11 at 10am-5pm",
            "Sun, Apr 12 at 10am-5pm",
            "Tue, Apr 14 thru Thu, Apr 16 at 10am-5pm",
            "Fri, Apr 17 at 10am-9pm",
            "Sat, Apr 18 at 10am-5pm",
            "Sun, Apr 19 at 10am-5pm",
            "Tue, Apr 21 thru Thu, Apr 23 at 10am-5pm",
            "Fri, Apr 24 at 10am-9pm",
            "Sat, Apr 25 at 10am-5pm",
            "Sun, Apr 26 at 10am-5pm",
            "Tue, Apr 28 thru Thu, Apr 30 at 10am-5pm",
            "Fri, May 1 at 10am-9pm",
            "Sat, May 2 at 10am-5pm",
            "Sun, May 3 at 10am-5pm",
            "Tue, May 5 thru Thu, May 7 at 10am-5pm",
            "Fri, May 8 at 10am-9pm",
            "Sat, May 9 at 10am-5pm",
            "Sun, May 10 at 10am-5pm",
            "Tue, May 12 thru Thu, May 14 at 10am-5pm",
            "Fri, May 15 at 10am-9pm",
            "Sat, May 16 at 10am-5pm",
            "Sun, May 17 at 10am-5pm",
            "Tue, May 19 thru Thu, May 21 at 10am-5pm",
            "Fri, May 22 at 10am-9pm",
            "Sat, May 23 at 10am-5pm",
            "Sun, May 24 at 10am-5pm",
            "Tue, May 26 thru Thu, May 28 at 10am-5pm",
            "Fri, May 29 at 10am-9pm",
            "Sat, May 30 at 10am-5pm",
            "Sun, May 31 at 10am-5pm",
            "Tue, Jun 2 thru Thu, Jun 4 at 10am-5pm",
            "Fri, Jun 5 at 10am-9pm",
            "Sat, Jun 6 at 10am-5pm",
            "Sun, Jun 7 at 10am-5pm",
            "Tue, Jun 9 thru Thu, Jun 11 at 10am-5pm",
            "Fri, Jun 12 at 10am-9pm",
            "Sat, Jun 13 at 10am-5pm",
            "Sun, Jun 14 at 10am-5pm",
            "Tue, Jun 16 thru Thu, Jun 18 at 10am-5pm",
            "Fri, Jun 19 at 10am-9pm",
            "Sat, Jun 20 at 10am-5pm",
            "Sun, Jun 21 at 10am-5pm",
            "Tue, Jun 23 thru Thu, Jun 25 at 10am-5pm",
            "Fri, Jun 26 at 10am-9pm",
            "Sat, Jun 27 at 10am-5pm",
            "Sun, Jun 28 at 10am-5pm",
            "Tue, Jun 30 thru Thu, Jul 2 at 10am-5pm",
            "Fri, Jul 3 at 10am-9pm",
            "Sat, Jul 4 at 10am-5pm",
            "Sun, Jul 5 at 10am-5pm",
            "Tue, Jul 7 thru Thu, Jul 9 at 10am-5pm",
            "Fri, Jul 10 at 10am-9pm",
            "Sat, Jul 11 at 10am-5pm",
            "Sun, Jul 12 at 10am-5pm",
            "Tue, Jul 14 thru Thu, Jul 16 at 10am-5pm",
            "Fri, Jul 17 at 10am-9pm",
            "Sat, Jul 18 at 10am-5pm",
            "Sun, Jul 19 at 10am-5pm",
            "Tue, Jul 21 thru Thu, Jul 23 at 10am-5pm",
            "Fri, Jul 24 at 10am-9pm",
            "Sat, Jul 25 at 10am-5pm",
            "Sun, Jul 26 at 10am-5pm",
            "Tue, Jul 28 thru Thu, Jul 30 at 10am-5pm",
            "Fri, Jul 31 at 10am-9pm",
            "Sat, Aug 1 at 10am-5pm",
            "Sun, Aug 2 at 10am-5pm",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Sun, Mar 15: ",
        ]), [
            "Sun, Mar 15",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Thu, Mar 19: 10am",
            "Fri, Mar 20: All day",
            "Sat, Mar 21: All day",
            "Sun, Mar 22: All day",
        ]), [
            "Thu, Mar 19 at 10am",
            "Fri, Mar 20 thru Sun, Mar 22",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Thu, Mar 19: 10:30am, 11:30am",
            "Fri, Mar 20: 10:30am, 11:30am",
            "Sat, Mar 21: 10:30am, 11:30am",
            "Sun, Mar 22: 10:30am, 11:30am",
        ]), [
            "Thu, Mar 19 thru Sun, Mar 22 at 10:30am, 11:30am",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Thu, Mar 19: 6:30pm",
        ]), [
            "Thu, Mar 19 at 6:30pm",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Thu, Mar 19: 10:30 and 11:30 a.m.",
            "Fri, Mar 20: 10:30 and 11:30 a.m.",
            "Sat, Mar 21: 10:30 and 11:30 a.m.",
            "Sun, Mar 22: 10:30 and 11:30 a.m.",
        ]), [
            "Thu, Mar 19 thru Sun, Mar 22 at 10:30, 11:30am",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Thu, Mar 19: 3pm",
        ]), [
            "Thu, Mar 19 at 3pm",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Thu, Mar 19: 11:00am",
        ]), [
            "Thu, Mar 19 at 11am",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Thu, Mar 19: 1 and 2 p.m.",
            "Fri, Mar 20: 1 and 2 p.m.",
            "Sat, Mar 21: 1 and 2 p.m.",
            "Sun, Mar 22: 1 and 2 p.m.",
        ]), [
            "Thu, Mar 19 thru Sun, Mar 22 at 1, 2pm",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Thu, Mar 19: 3 p.m.",
        ]), [
            "Thu, Mar 19 at 3pm",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Thu, Mar 19: 6:30 p.m.",
        ]), [
            "Thu, Mar 19 at 6:30pm",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Fri, Mar 20: Happy hour at 6:30pm, tour at 7:30pm",
        ]), [
            "Fri, Mar 20 at Happy hour at 6:30pm, tour at 7:30pm",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Fri, Mar 20: Happy hour at 6:00pm, tour at 7:30pm",
        ]), [
            "Fri, Mar 20 at Happy hour at 6pm, tour at 7:30pm",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Sat, Mar 21: 10am-5pm",
            "Sun, Mar 22: 10am-5pm",
        ]), [
            "Sat, Mar 21 at 10am-5pm",
            "Sun, Mar 22 at 10am-5pm",
        ]);

        $this->assertEquals($this->generateFormatted([
            "Sat, Mar 21: 10am-noon, 1-3pm",
            "Sun, Mar 22: 10am-noon, 1-3pm",
        ]), [
            "Sat, Mar 21 at 10am-12pm, 1-3pm",
            "Sun, Mar 22 at 10am-12pm, 1-3pm",
        ]);

        // Start testing passing in a different format
//        $this->assertEquals($this->generateFormatted([
//            1422248400,
//        ]), [
//            "Mon, Jan 26 at 5am",
//        ]);
//
//        $this->assertEquals($this->generateFormatted([
//            [
//                'date' => 1422248400,
//                'time' => '7:30pm',
//            ]
//        ]), [
//            "Mon, Jan 26 at 7:30pm",
//        ]);
    }

    private function generateFormatted($dates)
    {
        $recurrence = new \Recurrence\Recurrence();
        $recurrence->addDates($dates);

        $composerResults = $recurrence->getFormattedCompressedDates();

        $recurrence = new Recurrence();
        $recurrence->addDates($dates);

        $singleResults = $recurrence->getFormattedCompressedDates();

        if ($composerResults === $singleResults) {
            return $composerResults;
        }

        return false;
    }
}