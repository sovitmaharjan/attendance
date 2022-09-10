<h1>Reset Password</h1><br />
Click on the lint to reset your password: <a href="{{ route('reset-password', ['email' => $email, 'token' => $token]) }}"><button>Reset Password</button></a> <br />
{{ route('reset-password', ['token' => $token]) }}