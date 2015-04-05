<style>
	/*
div.container1 {
border:1px solid red;
border-left: 0px solid #444;
width:10px;
height:20px;
margin-right:-100px;
}

ul.column {
	float: left;
	padding: 0;
	list-style: none;
	/*width: 675px;*/
}

ul.column li {
	background: #fff;
	float: left;
	margin: 0px 0 0 25px;
	display: block;
	text-align: center;
	width: 200px;
	color: rgb(244, 51, 80);
	border-radius: 2px 2px 2px 2px;
	-webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;



}

ul.column li.box14 {
	width:250px;
	-webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
	-moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
	box-shadow:0 1px 6px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
}

ul.column.li.box14::before {
	left: -60px;
	top: 40%;
	border-right: 50px solid #444;
}
*/
/* Clear Float */


div.callout {
	height: 60px;
	width: 200px;
	float: left;
}

div.callout {
	background-color: #444;
	background-image: -moz-linear-gradient(top, #444, #444);
	position: relative;
	color: #ccc;
	padding: 0px;
	border-radius: 5px;
	box-shadow: 0px 0px 20px #999;
	margin: 2px;
	min-height: 70px;
	border: 1px solid #333;
	text-shadow: 0 0 1px #000;
}

.callout::before {
	content: "";
	width: 0px;
	height: 0px;
	border: 0.8em solid transparent;
	position: absolute;
}


.callout.right::before {
	height:10px;
	left: 0%;
	top: -20px;
	border-bottom: 10px solid #444;

	/*
	left: -60px;
	top: 0%;
	border-right: 50px solid #444;
	*/
}
	
</style>


<!--
<div id="addEvent" style="display: none; position: absolute; width: 400px; height: 400px; z-index: 1000;">
	<div class="container1">
	  <div class="box-collection">
		<ul class="column">
		  <li class="box14" id="calendardata">Shadow 14 </li>
		</ul>
	  </div>
	</div>
</div>
-->
<div id="addEvent" style="display: none; position: absolute; width: 400px; height: 400px; z-index: 1000;">
	<div class="callout right" >
		<div id="calendardata"></div>
	</div>
</div>



<?php

//http://localhost/hoauthmasteryii/index.php?r=zoowical/efullevents
echo "Note: <b style='color:red'>jquery.min.js</b> Javascript is commented in the main.php for this page and function to work , Need to check any breaks and load all javascript and css with yii." ;

$cs = Yii::app()->clientScript;
$cs->scriptMap['jquery.min.js'] = false;



$this->widget('ext.EFullCalendar.EFullCalendar', array(

    'themeCssFile'=>'cupertino/theme.css',
 
    // raw html tags
    'htmlOptions'=>array(
        // you can scale it down as well, try 80%
        'style'=>'width:60%'
    ),
    // FullCalendar's options.
    // Documentation available at
    // http://arshaw.com/fullcalendar/docs/
    'options'=>array(
        'header'=>array(
            'left'=>'prev,next',
            'center'=>'title',
            'right'=>'today'
        ),
        'lazyFetching'=>true,
        //'events'=>$calendarEventsUrl, // action URL for dynamic events, or
		'events'=>CController::createUrl('zoowical/CalendarEvents'),			   

        // mouseover for example
  //      'eventMouseover'=>new CJavaScriptExpression("js_function_callback"),
        'eventMouseover'=>new CJavaScriptExpression("displayEventPopup = function (calEvent, jsEvent, view){
			var data = calEvent.title; 	data +=	'<br/>' + calEvent.start;
			$('#calendardata').html(data);
			$('#addEvent').css({ left: jsEvent.pageX, top: jsEvent.pageY }).show().fadeIn();

	}

	"),

        'eventMouseout'=>new CJavaScriptExpression("hideEventPopup = function (calEvent, jsEvent, view){
			$('#addEvent').css({ left: jsEvent.pageX, top: jsEvent.pageY }).hide().fadeOut();
	}"),	
    )
));
?>
