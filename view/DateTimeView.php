<?php

class DateTimeView {


	public function show() {
		$nameOfDay = date("l");
		$dateOfDay = date("jS");
		$month = date("F");
		$year = date("o");
		$time = date("G:i:s");


		//$timeString = date("l \\t\\h\\e jS \of F Y, \\T\\h\\e \\t\\i\\m\\e  \\i\\s G:i:s");
		$timeString = $nameOfDay . " the " . $dateOfDay . " of " . $month . " " . $year . ", The time is " . $time;

		return '<p>' . $timeString . '</p>';
	}
}