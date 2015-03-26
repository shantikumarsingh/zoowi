<?php
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;

class FilterController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(

			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionIndex()
	{

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

	public function actionImage(){
		if(Yii::app()->user->isGuest)
			Yii::app()->user->loginRequired();
		$this->render('imageFilter');	
			
	}
	
}