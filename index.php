<?php
/*
 * Created on Aug 1, 2017
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<html>
	 <head>
	 	<link rel="stylesheet" type="text/css" href="style.css">
	 	<script type="text/javascript" >
	 		function checkDate(){
	 			var startObj = document.getElementById("start_date");
	 			var endObj = document.getElementById("end_date");
	 			var startdateObj = document.getElementById("startdate_timezone");
	 			var enddateObj = document.getElementById("enddate_timezone");
	 			if (startObj.value.length == 0 || endObj.value.length == 0) {
	 				alert("Please select both start date and end date");
	 				return;	
	 			}
	 			if (startObj.value > endObj.value) {
	 				alert("Start Date should be less than end date. Please modify");
	 				return;	
	 			}
	 			if ((startdateObj.value === 'none' && enddateObj.value !== 'none')
	 			          || (startdateObj.value !== 'none' && enddateObj.value === 'none')) {
	 				alert("Please select a timezone for both Start and End Date");
	 				return;
	 			}
	 			
	 			document.getElementById('dateCalc').submit();
	 		}
	 		function checkCalculateOption(){
	 			var daysObj = document.getElementById("days");
	 			var weekdaysObj = document.getElementById("weekdays");
	 			var weeksObj = document.getElementById("weeks");
	 			var yearsObj = document.getElementById("years");
	 			if(weekdaysObj.checked || weeksObj.checked) {
	 				yearsObj.disabled = true;
	 			}
	 			else if(daysObj.checked){
	 				yearsObj.disabled = false;
	 			}
	 		}
	 	</script>
	 </head>
	 <body>
		 <div id="main">
		 <h1>Date difference Calculator</h1>
	 	 <h5>Note: Please select both date and time. Time can be entered using the numeric keys or the small arrows to the right.</h5>
		    <form action="dateCalculator.php" method="post" id="dateCalc" >
		    	<div class="sub">
		    		<div class="entity">
						<div class="label"><label>Start Date: </label></div><div class="field"><input type="datetime-local" name="start_date" id="start_date" value=""></div>
						<div class="field">
							<select name="startdate_timezone" id="startdate_timezone">
								<option value="none">Select a Timezone</option>
							    <option value="Australia/Adelaide">(GMT+09:30) Australia, Adelaide</option>
							    <option value="Asia/Kolkata">(GMT+05:30) India, Chennai</option>
							    <option value="Europe/Amsterdam">(GMT+01:00) Europe, Amsterdam</option>
							</select>
						</div>
					</div>
					<div class="entity">
						<div class="label"><label>End Date: </label></div><div class="field"><input type="datetime-local" name="end_date" id="end_date" value=""></div>
						<div class="field">
							<select name="enddate_timezone" id="enddate_timezone">
								<option value="none">Select a Timezone</option>
							    <option value="Australia/Adelaide">(GMT+09:30) Australia, Adelaide</option>
							    <option value="Asia/Kolkata">(GMT+05:30) India, Chennai</option>
							    <option value="Europe/Amsterdam">(GMT+01:00) Europe, Amsterdam</option>
							</select>
						</div>
					</div>
					<div class="entity">
						 <div class="label"><label>Calculate: </label></div>
						 <div class="field">
						 	 <input type="radio" name="diffIn" id="days" value="days" checked onchange="checkCalculateOption()">Number of days<br>
						  	 <input type="radio" name="diffIn" id="weekdays" value="weekdays" onchange="checkCalculateOption()">Number of weekdays<br>
						  	 <input type="radio" name="diffIn" id="weeks" value="weeks" onchange="checkCalculateOption()">Number of complete weeks<br>
						 </div> 
					</div>
					<div class="entity">
						 <div class="label"><label>Display Format: </label></div>
						 <div class="field">
						 	 <input type="radio" name="format" value="none" checked>None
						 	 <br><input type="radio" name="format" value="years" id="years">Years
						  	 <br><input type="radio" name="format" value="hours">Hours
						  	 <br><input type="radio" name="format" value="minutes">Minutes
						  	 <br><input type="radio" name="format" value="seconds">Seconds
						 </div> 
					</div>
<!--					<div class="entity">
						 <div class="label"><label>Timezone: </label></div>
						 <div class="field">
							<select name="timezone_offset" id="timezone-offset" class="span5">
							    <option value="-12:00">(GMT -12:00) Eniwetok, Kwajalein</option>
							    <option value="-11:00">(GMT -11:00) Midway Island, Samoa</option>
							    <!--<option value="-10:00">(GMT -10:00) Hawaii</option>
							    <option value="-09:50">(GMT -9:30) Taiohae</option>
							    <option value="-09:00">(GMT -9:00) Alaska</option>
							    <option value="-08:00">(GMT -8:00) Pacific Time (US &amp; Canada)</option>
							</select>
						 </div> 
					</div>-->
					<div class="btnCalculate">
						<button id="submitDate" type="button" onclick="checkDate()">Calculate</button>
					</div>
				</div>
		    </form>
		 </div>
	 </body>
 </html>