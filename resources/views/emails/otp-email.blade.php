@component('mail::message')

Here is your One-Time Password (OTP):
<br>
<div style="font-weight: 900; text-align: center; font-size:32px; color: blue">{{ $otp }}</div>
<br>

Note: This OTP is valid for only {{ $expireInMins }} minutes. Please don't disclose this code to anybody.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
