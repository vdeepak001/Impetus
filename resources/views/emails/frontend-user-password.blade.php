<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @if($type === 'forgot')
            Reset Password OTP - {{ config('app.name', 'Ventura') }}
        @else
            Welcome to {{ config('app.name', 'Ventura') }}
        @endif
    </title>
</head>
<body style="margin: 0; padding: 0; background-color: #f8fafc; font-family: Inter, Arial, sans-serif; color: #1e293b;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #f8fafc; padding: 24px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width: 620px; background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 18px; overflow: hidden;">
                    <tr>
                        <td align="center" style="padding: 24px 24px 16px;">
                            <img src="{{ $message->embed(public_path('images/venture.svg')) }}" alt="Venture Logo" style="height: 40px; width: auto; display: block;">
                        </td>
                    </tr>
                    <tr>
                        <td style="background: linear-gradient(135deg, #0082c9 0%, #83ba2d 100%); padding: 24px;">
                            @if($type === 'forgot')
                                <h1 style="margin: 0; color: #ffffff; font-size: 24px; line-height: 1.3; font-weight: 700;">
                                    Reset Password OTP
                                </h1>
                                <p style="margin: 8px 0 0; color: #f8fafc; font-size: 14px; line-height: 1.6;">
                                    Your One-Time Password to reset your account credentials.
                                </p>
                            @else
                                <h1 style="margin: 0; color: #ffffff; font-size: 24px; line-height: 1.3; font-weight: 700;">
                                    Welcome, {{ $user->name }}!
                                </h1>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 24px;">
                            @if($type === 'forgot')
                                <p style="margin: 0 0 20px; font-size: 15px; line-height: 1.7; color: #334155;">
                                    Dear User, your OTP <strong>{{ $generatedPassword }}</strong> for FORGOT PASSWORD. Valid for 10 minutes. DO NOT SHARE. For any further assistance mail us to <a href="mailto:info@venturacpd.com" style="color: #0082c9; font-weight: 600; text-decoration: underline;">info@venturacpd.com</a>
                                </p>

                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border: 1px solid #e2e8f0; border-radius: 12px; background-color: #f8fafc; margin-bottom: 20px;">
                                    <tr>
                                        <td align="center" style="padding: 20px 16px; font-size: 32px; letter-spacing: 6px; font-weight: 800; color: #0082c9; font-family: monospace;">
                                            {{ $generatedPassword }}
                                        </td>
                                    </tr>
                                </table>
                            @else
                                <p style="margin: 0 0 20px; font-size: 15px; line-height: 1.7; color: #334155;">
                                    Thank you for registering with Ventura Learning Solutions, User name: <strong>{{ $user->email }}</strong> Password: <strong>{{ $generatedPassword }}</strong> VLSID: <strong>{{ $user->unique_sequence_number }}</strong>. For any further assistance mail us to <a href="mailto:info@venturacpd.com" style="color: #0082c9; font-weight: 600; text-decoration: underline;">info@venturacpd.com</a>
                                </p>

                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border: 1px solid #e2e8f0; border-radius: 12px; background-color: #f8fafc; margin-bottom: 20px;">
                                    <tr>
                                        <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0; font-size: 14px; color: #475569;">
                                            <strong style="color: #0f172a;">User name (Email):</strong> {{ $user->email }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0; font-size: 14px; color: #475569;">
                                            <strong style="color: #0f172a;">Password:</strong> {{ $generatedPassword }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 14px 16px; font-size: 14px; color: #475569;">
                                            <strong style="color: #0f172a;">VLSID:</strong> {{ $user->unique_sequence_number }}
                                        </td>
                                    </tr>
                                </table>
                            @endif

                            <p style="margin: 20px 0 0; font-size: 14px; line-height: 1.7; color: #475569;">
                                For security, please log in and change your password immediately after your first sign in.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 16px 24px 24px; border-top: 1px solid #f1f5f9;">
                            <p style="margin: 0; font-size: 12px; line-height: 1.7; color: #64748b;">
                                &copy; {{ date('Y') }} {{ config('app.name', 'Ventura') }}. All rights reserved.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
