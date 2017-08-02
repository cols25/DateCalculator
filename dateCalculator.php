<?php
/*
 * Created on Aug 1, 2017
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

class DateCalculator
{
	private $startDate;
	private $endDate;
	private $displayFormat;
	private $noOfDays;
	private $noOfWeekdays;
	private $noOfWeeks;
	private $weekStart;
	private $theDay;
	private $noOfYears;
	private $noOfHours;
	private $noOfMinutes;
	private $noOfSeconds;
	private $timeInterval;
	
	#Number of days between two datetime parameters
	public function getNoOfDays($startDate, $endDate, $displayFormat)
    {
      	$this->startDate = new DateTime($startDate);
      	$this->endDate = new DateTime($endDate);
      	$this->displayFormat = $displayFormat;
      	$this->noOfDays = $this->startDate->diff($this->endDate);
			switch($this->displayFormat){
				case "years": 
					$this->noOfYears = floor($this->noOfDays->format('%a')/365);
					return $this->noOfYears." year(s)";
					break;
				case "hours":
					$this->noOfHours = ($this->noOfDays->format('%a')*24) + $this->noOfDays->format('%h');
					return $this->noOfHours." hour(s)"; 
					break;
				case "minutes":
					$this->noOfMinutes = ($this->noOfDays->format('%a')*(60*24)) + ($this->noOfDays->format('%h')*60) + $this->noOfDays->format('%i');
					return $this->noOfMinutes." minute(s)";
					break;
				case "seconds":
					$this->noOfSeconds = ($this->noOfDays->format('%a')*(60*60*24)) + ($this->noOfDays->format('%h')*(60*60)) + ($this->noOfDays->format('%i')*60) + $this->noOfDays->format('%s');
					return $this->noOfSeconds." second(s)";
					break;
				default :
					$this->noOfDays = $this->noOfDays->format('%a');
					return $this->noOfDays." day(s)";
					break;
			}
    }
 
    #Number of weekdays between two datetime parameters
    public function getNoOfWeekdays($startDate, $endDate, $displayFormat)
    {
      	$this->noOfWeekdays = 0;
      	$this->tempStartDate = new DateTime($startDate);
      	$this->tempEndDate = new DateTime($endDate);;
      	$this->startDate = strtotime($startDate);
      	$this->endDate = strtotime($endDate);
      	$this->displayFormat = $displayFormat;
      	$this->timeInterval = $this->tempStartDate->diff($this->tempEndDate);
      	while($this->startDate <= $this->endDate){
    	$this->theDay = date("N",$this->startDate);
     		if($this->theDay<=5) { // 6 and 7 are weekends
          		$this->noOfWeekdays++; // no of weekdays in the given interval
     		}
    		$this->startDate +=86400; // +1 day
  		};
  		switch($this->displayFormat){
//			case "years": 
//				$this->noOfYears = floor($this->noOfDays->format('%a')/365);
//				return $this->noOfYears." year(s)";
//				break;
			case "hours":
				//print_r($this->noOfWeekdays->format('%y Year(s) %m Month(s) %d Day(s) %h Hour(s) %i Minute(s) %s Seconds'));
				$this->noOfHours = floor($this->noOfWeekdays * 24) + $this->timeInterval->format('%h');
				return $this->noOfHours." hour(s)"; 
				break;
			case "minutes":
				$this->noOfMinutes = floor($this->noOfWeekdays * (60*24)) + ($this->timeInterval->format('%h')*60) + $this->timeInterval->format('%i');
				return $this->noOfMinutes." minute(s)";
				break;
			case "seconds":
				$this->noOfSeconds = floor($this->noOfWeekdays * (60*60*24)) + ($this->timeInterval->format('%h')*(60*60)) + ($this->timeInterval->format('%i')*60) + $this->timeInterval->format('%s');
				return $this->noOfSeconds." second(s)";
				break;
			default :
				return $this->noOfWeekdays." weekday(s)";
				break;
		}
    }
    
    #Number of complete weeks between two datetime parameters
	public function getNoOfWeeks($startDate, $endDate, $displayFormat)
	{
		$this->weekStart = 0;
		$this->noOfWeeks = 0;
      	$this->startDate = strtotime($startDate);
      	$this->endDate = strtotime($endDate);
      	while($this->startDate <= $this->endDate){
    	$this->theDay = date("N",$this->startDate);
     		if($this->theDay == 1) { // check if Monday
          		$this->weekStart = 1; // flag weekStart to 1 if Monday
       		}
       		if($this->weekStart == 1 && $this->theDay == 7) { // check if week has started and present day is Sunday
       			$this->noOfWeeks++;   // increment number of weeks
       			$this->weekStart = 0; // reset flag(weekStart) to zero
       		}
    		$this->startDate +=86400; // +1 day
  		};
  		return $this->noOfWeeks." week(s)";
	}
	
	#Accept a third parameter to convert the result into one of seconds, minutes, hours, years

	#Timezone for comparison of input parameters from different timezones 
	
}

	if(empty($_POST['start_date']) || empty($_POST['end_date'])){ //validated on both client and server side
		echo "Please select both start date and end date";
		exit;
	}
	elseif($_POST['start_date'] > $_POST['end_date']){ //validated on both client and server side
		echo "Start date should be less than End date. Please modify";
		exit;
	}

	$calc = new DateCalculator();

	if($_POST['diffIn'] == "days")
	{
		if(isset($_POST['format']))
		{
			echo $noofdays = $calc->getNoOfDays($_POST['start_date'],$_POST['end_date'],$_POST['format']);
		}
		else
			echo $noofdays = $calc->getNoOfDays($_POST['start_date'],$_POST['end_date'],'');
	}
	elseif($_POST['diffIn'] == "weekdays")
	{
		if(isset($_POST['format']))
		{
			echo $noofweekdays = $calc->getNoOfWeekdays($_POST['start_date'],$_POST['end_date'],$_POST['format']);
		}
		else
			echo $noofweekdays = $calc->getNoOfWeekdays($_POST['start_date'],$_POST['end_date'],'');
	}
	elseif($_POST['diffIn'] == "weeks")
	{
		if(isset($_POST['format']))
		{
			echo $noofweeks = $calc->getNoOfWeeks($_POST['start_date'],$_POST['end_date'],$_POST['format']);
		}
		else
			echo $noofweeks = $calc->getNoOfWeeks($_POST['start_date'],$_POST['end_date'],false);
	}

?>
