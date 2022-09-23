<h1>Set Password</h1><br />
Click on the lint to set your password: <a href="{{ route('set-password', ['email' => $email, 'token' => $token]) }}"><button>Set Password</button></a> <br />
{{ route('set-password', ['token' => $token]) }}