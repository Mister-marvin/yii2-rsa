# yii2-rsa
rsa


getKey:
 public function actionIndex(){

		$rsa = Yii::$app->rsa;
		$k = $rsa->generateKey();
		print_r($k['public_key']);
		print_r($k['private_key']);
}

config:

 'components' => [
 	'rsa'=>[
			'class' => 'mistermarvin\rsa\Rsa',
			'public_key' => $params['rsa']['publicKey'],
			'private_key' => $params['rsa']['privateKey'],
	],
	....
]

use:
 public function actionIndex(){
 	$rsa = Yii::$app->rsa;
	$data = $rsa->encrypt('hello rsa');
	echo $rsa->decrypt($data);
}