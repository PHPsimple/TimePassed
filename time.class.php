<?php

	class Time
	{

		protected $_current_time;
		protected $_time_to_calculate;

		public function __construct()
		{
			$this->_current_time = time();
		}

		protected function _time_calculate($time)
		{
			$this->_time_to_calculate = $time;

			$time = date_create($this->_time_to_calculate);
			$time = date_timestamp_get($time);

			$time = $this->_current_time - $time;

			$minutes = floor($time / 60);
			$hours	 = floor($minutes / 60);

			$time = array(
				'minutes' 			=> $minutes,
				'hours' 			=> $hours,
				'time_to_calculate' => $this->_time_to_calculate);

			return $time;
		}

		public function _passed_time($time)
		{
			$time = $this->_time_calculate($time);

			$minutes 			= $time['minutes'];
			$hours	 			= $time['hours'];
			$time_to_calculate 	= $time['time_to_calculate'];

			if($minutes < 59) {
				if($minutes == 1) {
					return "One minute ago";
				} else {
					return "{$minutes} minutes ago";
				}
			} else if($minutes == 60 || $minutes > 60) {
				if($hours == 1) {
					return "One hour ago";
				} else if($hours == 24 || $hours > 24) {
					if($hours > 24 && $hours < 48) {
						return "One day ago";
					} else if($hours > 48 && $hours < 72) {
						return "Two days ago";
					} else if($hours > 72 && $hours < 96) {
						return "Three days ago";
					} else {
						return $time_to_calculate;
					}
				} else {
					return "{$hours} hours ago";
				}
			}
		}
	}
