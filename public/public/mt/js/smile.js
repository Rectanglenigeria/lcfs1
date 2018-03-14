
//smile.js javascript
//author Olakunle Aladeusi (github:@gbemiAlad)
	
$(document).ready(
	function() {


		var date = new Date(2017, 07, 30);
		var now = new Date();
		var diff = now.getTime()/1000 - date.getTime()/1000;
		clock =$(.countdown).FlipClock(diff,{
			clockFace:'DailyCounter',
			countdown: false
		});
		// Instantiate a counter
		//var clock = new FlipClock($('.countDown'), {
		//	clockFace: 'DailyCounter',	
		//		});
		//set time
		//clock.setTime(diff);
		//clock.start();
        //start countdown
		//clock.setCountdown(true);
});
	



    


