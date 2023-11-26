<div>
    @if($mailData['type'] === \App\Models\ProfileReset::RESET_TYPE_PASSWORD)
        <a href="{{ url('/reset/password/confirm/' . $mailData['token']) }}">Click here for confirm</a>
    @else
        <div>Verification code is <strong>{{ $mailData['code'] }}</strong></div>
    @endif
</div>
