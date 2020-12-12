{{ trans('passwords.reset_password_email') }}
 <br />
 <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
