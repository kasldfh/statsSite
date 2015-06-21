<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h4>Hello {{$name}}, welcome to the CoD Stats team!</h4>

		<p>
			To create your account, please complete this form: <br/> <a href="{{ URL::to('users/create', array($token)) }}">Here</a><br/><br/>
			Please remember to <b>never</b> give out your account information to anyone.</br>We are excited to have you as part of the team!
		</p>


	</body>
</html>
