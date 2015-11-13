<div class="container">

    <div class="omb_login">

  		<div class="row omb_row-sm-offset-3">
  			<div class="col-xs-12 col-sm-6">

          {!! Form::open(['to' => 'auth/register', 'class' => 'omb_loginForm', 'role' => 'form','data-toggle'=>'validator', 'data-delay'=>'1100']) !!}

            <div id="form-part-1">

              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                {!! Form::input('user_name','user_name',old('user_name'), ['class' => 'form-control', 'placeholder' => 'Username','required','id' => 'user_name']) !!}
              </div>
              @if ($errors)
                <span class="help-block">{{$errors->first('Username')}}</span>
              @endif

              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                {!! Form::input('email', 'email', old('email'), ['class' => 'form-control', 'placeholder' => 'Email Address','required','data-error'=> 'Invalid email address','id' => 'email']) !!}
              </div>
              @if ($errors)
                <span class="help-block">{{$errors->first('Email')}}</span>
              @endif

              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                {!! Form::input('password', 'password', null, ['class' => 'form-control', 'placeholder' => 'Password','data-minlength'=>'6','required','id' => 'password']) !!}
              </div>
              @if ($errors)
                <span class="help-block">{{$errors->first('Password')}}</span>
              @endif

              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                {!! Form::input('password', 'password_confirmation', null, ['class' => 'form-control', 'placeholder' => 'Password Confirmation','data-minlength'=>'6','required','id' => 'password']) !!}
              </div>
              @if ($errors)
                <span class="help-block">{{$errors->first('Password')}}</span>
              @endif

              <br>

              {!! Form::token() !!}

              <a type="button" href="#" class="btn btn-lg btn-primary btn-block" onclick="pageUpdate()">JOIN</a>
              <button type="button" id="modalSuccessButton" class="btn btn-default" data-toggle="modal" data-target="#successModal" style="display:none">MODAL S</button>
              <button type="button" id="modalErrorButton" class="btn btn-default" data-toggle="modal" data-target="#errorModal" style="display:none">MODAL ERROR</button>

            </div>

            <div id="form-part-2" style="display:none">
              

              {!! Form::submit('Login', ['class' => 'btn btn-lg btn-primary btn-block']) !!}
            </div>

          {!! Form::close() !!}

  			</div>
      </div>

      <div class="row omb_row-sm-offset-3">
  			<div class="col-xs-12 col-sm-3">
  				<label class="checkbox">
            {!! Form::checkbox('remember-me') !!} {{ trans('labels.remember_me') }}
  				</label>
  			</div>
  		</div>

      <div class="row omb_row-sm-offset-3 omb_loginOr">
  			<div class="col-xs-12 col-sm-6">
  				<hr class="omb_hrOr">
  			</div>
  		</div>

      <div class="form-group">
        <div class="col-md-12 control">
          Already a member?
          <a href="{{url('auth/login')}}">
          Login Here
          </a>
        </div>
      </div>

	</div>

</div>

<style media="screen">
  @media (min-width: 768px) {
    .omb_row-sm-offset-3 div:first-child[class*="col-"] {
        margin-left: 25%;
    }
  }

  .omb_login .omb_authTitle {
    text-align: center;
    line-height: 300%;
  }

  .omb_login .omb_socialButtons a {
  color: white; // In yourUse @body-bg
  opacity:0.9;
  }
  .omb_login .omb_socialButtons a:hover {
    color: white;
  opacity:1;
  }
  .omb_login .omb_socialButtons .omb_btn-facebook {background: #3b5998;}
  .omb_login .omb_socialButtons .omb_btn-twitter {background: #00aced;}
  .omb_login .omb_socialButtons .omb_btn-google {background: #c32f10;}


  .omb_login .omb_loginOr {
  position: relative;
  font-size: 1.5em;
  color: #aaa;
  /*margin-top: 1em;*/
  margin-bottom: 0.5em;
  padding-top: 0.5em;
  padding-bottom: 0.5em;
  }
  .omb_login .omb_loginOr .omb_hrOr {
  background-color: #cdcdcd;
  height: 1px;
  margin-top: 0px !important;
  margin-bottom: 0px !important;
  }
  .omb_login .omb_loginOr .omb_spanOr {
  display: block;
  position: absolute;
  left: 50%;
  top: -0.6em;
  margin-left: -1.5em;
  background-color: white;
  width: 3em;
  text-align: center;
  }

  .omb_login .omb_loginForm .input-group.i {
  width: 2em;
  }
  .omb_login .omb_loginForm  .help-block {
    color: red;
  }


  @media (min-width: 768px) {
    .omb_login .omb_forgotPwd {
      text-align: right;
      margin-top:10px;
    }
  }

  .omb_forgotPwd {
    text-align: left;
  }

  .checkbox {
    text-align: left;
    margin-left: 20px;
  }
</style>