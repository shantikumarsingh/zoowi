<?php

class ZoowicalController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{

		$this->render('index');
	}
	
	public function actionCalendar() {

	 
	  $this->render('calendar');
	}

	public function actionEfullevents(){
		$this->render('efullevents');
	}
	public function actionCalendarEvents()
	{
		$items[]=array(
			'title'=>'Meeting With Smita',
			'start'=>'2015-04-12 09:30',
			'color'=>'#CC0000',
			'allDay'=>false,
			//'url'=>'http://anyurl.com'
		);
		$items[]=array(
			'title'=>'Meeting With Aadi',
			'start'=>'2015-04-14 09:30',
			'color'=>'#A2A2A2',
			'allDay'=>false,
			//'url'=>'http://anyurl.com'
		);
		$items[]=array(
			'title'=>'Meeting reminderMeeting reminder Meeting reminder',
			'start'=>'2015-04-25 09:30',
			'end'=>'2015-04-21',
	 
			// can pass unix timestamp too
			// 'start'=>time()
	 
			'color'=>'blue',
		);
		$items[]=array(
			'title'=>'Meeting reminder in May',
			'start'=>'2015-05-19 09:30',
			'end'=>'2015-04-21',
	 
			// can pass unix timestamp too
			// 'start'=>time()
	 
			'color'=>'green',
		);
		echo CJSON::encode($items);
		Yii::app()->end();
	}
}
