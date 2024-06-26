@extends('emails.layouts.default')

@section('content')
    <p>Hello {{ $user->first_name }},</p>
    <p>Welcome to {{ config('app.name') }}.</p>
    <p>Please, click below to confirm your account.</p>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
        <tbody>
        <tr>
            <td align="left">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                    <tr>
                        <td> <a href="{{ config('app.portal_url') }}/verify-email?token={{ $user->token }}" target="_blank">Confirmar conta</a> </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
@endsection