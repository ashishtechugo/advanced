<!--Login Box Model Start Here-->
<div id="loginmodel" class="modal fade" role="dialog">
  <div class="loginwrap">
    <div class="loginbox">
      <div class="login">
        <div id="loginbox" class="mainbox col-md-8">
          <div class="panel">
            <div class="titlebox">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3>Sign In <span>for</span> <span class="yellow">TIXILO</span></h3>
              <p>You'll have all the Slurm you can drink when you're partying.</p>
            </div>
            <div class="row">
              <div class="loginboxCon clearfix">
                <form class="form-horizontal" role="form">
                  <div class="col-md-6">
                    <div class="formbox">
                      <div class="inputbox">
                        <div class="input-group"> <span class="input-group-addon email"><i class="glyphicon user"></i></span>
                          <input type="text" class="form-control" name="name" id="name"  placeholder="Email"/>
                        </div>
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon pass"></i></span>
                          <input type="password" class="form-control" name="name" id="name"  placeholder="Password"/>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary signin">Sign In</button>
                          </div>
                        </div>
                      </div>
                      <div class="orbox">
                        <div class="line"></div>
                        <div class="ortext">OR</div>
                        <div class="line"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="socialrow">
                      <div class="form-group"><a class="btn btn-block btn-social btn-facebook"> <span class="fa fa-facebook"></span> Sign Up with Facebook </a></div>
                      <div class="form-group"><a class="btn btn-block btn-social btn-twitter"> <span class="fa fa-twitter"></span> Sign Up with Twitter </a> </div>
                      <div class="form-group"><a class="btn btn-block btn-social btn-google"> <span class="fa fa-google-plus"></span> Sign Up with Google+ </a></div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="regiterrow">
                <p>Bender, hurry! This fuel's expensive! Also, we're dying! Bender, you risked your life to save me!</p>
                <p class="register"><a href="javascript:void(0);" id="showsign">New Member?</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--Login Box Model End Here--> 

<!--Sign Up Box Model Start Here-->
<div id="signupmodel" class="modal fade" role="dialog">
  <div class="loginwrap">
    <div class="loginbox">
      <div class="login">
        <div id="loginbox" class="mainbox col-md-8">
          <div class="panel">
            <div class="titlebox">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3>Sign Up <span>for</span> <span class="yellow">TIXILO</span></h3>
              <p>You'll have all the Slurm you can drink when you're partying.</p>
            </div>
            <div class="row">
              <div class="loginboxCon clearfix">
            
	   <?php $form = ActiveForm::begin([
    'id' => 'signup-form',
    'enableAjaxValidation' => true,
    'validateOnSubmit'     => true,
    ]);?>
                  <div class="col-md-12">
                    <div class="formbox">
                      <div class="inputbox signup">
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon name"></i></span>
                         <?= $form->field($model, 'userFullName')->textInput(['placeholder' => "Name"])->label('')?>
                        </div>
                        <div class="input-group"> <span class="input-group-addon mobile"><i class="glyphicon mobile"></i></span>
                         <?= $form->field($model, 'phone_number')->textInput(['placeholder' => "Mobile"])->label('')?>
                        </div>
                        <div class="input-group"> <span class="input-group-addon email"><i class="glyphicon user"></i></span>
                          <?= $form->field($model, 'email')->textInput(['placeholder' => "Email"])->label('')?>
                        </div>
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon pass"></i></span>
                          <?= $form->field($model, 'password')->passwordInput(['placeholder' => "Password"])->label('')?>
                        </div>
                        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon pass"></i></span>
                         <?= $form->field($model, 'confirm_password')->passwordInput(['placeholder' => "Confirm Password"])->label('')?>
                        </div>
                        <div class="form-group">
                          <div class="checkboxrow">
                            
                           <?= $form->field($model, 'term')->checkbox(array('label'=>''))->label('I have read and accept the Terms and Conditions.'); ?>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-12">
                            <?= Html::submitButton('Sign UP', ['class'=> 'btn btn-primary signin']) ;?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              <?php ActiveForm::end(); ?>
              </div>
              <div class="regiterrow">
                <p>Bender, hurry! This fuel's expensive! Also, we're dying! Bender, you risked your life to save me!</p>
                <p class="register"><a href="javascript:void(0);" id="showlogin">Already Member?</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--Sign Up Model End Here-->