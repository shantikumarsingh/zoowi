<?php

class NotificationsController extends Controller
{
	public function actions()
	{
		return array(
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	public function actionIndex() {
		if(Yii::app()->user->isGuest)
			Yii::app()->user->loginRequired();
		$this->render('index');
	}
	
	public function actionError() {
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
}