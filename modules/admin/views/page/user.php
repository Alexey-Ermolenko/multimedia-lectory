<?
$this->registerJsFile('/modules/admin/web/js/admin.js', ['depends' => [\yii\web\JqueryAsset::className()]]);


?>

<div class="container-fluid">
    <h1>User Info</h1>
    <?
    if (Yii::$app->user->identity->role == \app\models\User::ROLE_ADMIN)
    {
        ?>
		<h2>Данный пользователь - Администратор</h2>
		<a class="btn btn-outline-default waves-effect" href="/admin/page/user-list"> 
			<i class="fa fa-th-list" aria-hidden="true"></i> Список пользователей
		</a>
		<?
    } else {
		?>
        <h2>Пользователь</h2>
		<?
    }
    ?>
	<a class="btn aqua-gradient btn-rounded btn-lg" href="/admin/page/user-edit"> <i class="fa fa-edit" aria-hidden="true"></i> Редактирование</a>
	<br>
    <div class="card profile-card">
        <div class="card-body pt-0 mt-0">
            <ul class="striped list-unstyled">
                <li><strong>ID:</strong> <?=Yii::$app->user->identity->getId()?></li>
                <li><strong>Email:</strong> <?=Yii::$app->user->identity->email?></li>
                <li><strong>Role:</strong> <?=Yii::$app->user->identity->role?></li>
                <li><strong>Auth Key:</strong> <?=Yii::$app->user->identity->auth_key?></li>
                <li><strong>Password Hash:</strong> <?=Yii::$app->user->identity->password_hash?></li>
                <li><strong>Created At:</strong> <?=Yii::$app->user->identity->created_at?></li>
                <li><strong>Updated At:</strong> <?=Yii::$app->user->identity->updated_at?></li>
                <li><strong>Password Reset Token:</strong> <?=Yii::$app->user->identity->password_reset_token?></li>
                <li><strong>Username:</strong> <?=Yii::$app->user->identity->username?></li>
                <li><strong>Desc:</strong> <?=Yii::$app->user->identity->desc?></li>
            </ul>
        </div>
    </div>

	<br>	
	
    <?
   // http://lectory.yii/admin/page/user/?id=10
   // Yii::$app->userHelperClass->pre('user');
   // Yii::$app->userHelperClass->pre(Yii::$app->user);

    ?>
</div>