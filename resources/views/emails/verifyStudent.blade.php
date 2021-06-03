@component('mail::message')
# Email Verification

Hey {{ $user->name }} you have recently regester in eduOnline please verify your email.
<?php $user_id = $user->id ?>
@component('mail::button', ['url' => 'http://eduonline.com/confirmVerification/'.$user_id])
Verify Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
