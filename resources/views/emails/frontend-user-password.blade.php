<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @if($type === 'forgot')
            Temporary Password - {{ config('app.name', 'Ventura') }}
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
                        <td style="background: linear-gradient(135deg, #0082c9 0%, #83ba2d 100%); padding: 28px 24px;">
                            @if($type === 'forgot')
                                <h1 style="margin: 0; color: #ffffff; font-size: 24px; line-height: 1.3; font-weight: 700;">
                                    Temporary Password
                                </h1>
                                <p style="margin: 8px 0 0; color: #f8fafc; font-size: 14px; line-height: 1.6;">
                                    Your temporary login credentials to access your account.
                                </p>
                            @else
                                <h1 style="margin: 0; color: #ffffff; font-size: 24px; line-height: 1.3; font-weight: 700;">
                                    Welcome, {{ $user->name }}!
                                </h1>
                                <p style="margin: 8px 0 0; color: #f8fafc; font-size: 14px; line-height: 1.6;">
                                    Your account has been created successfully.
                                </p>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 24px;">
                            <p style="margin: 0 0 16px; font-size: 15px; line-height: 1.5; color: #475569;">
                                Here are your login details:
                            </p>

                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border: 1px solid #e2e8f0; border-radius: 12px; background-color: #f8fafc; margin-bottom: 24px; overflow: hidden; border-collapse: separate;">
                                <tr>
                                    <td style="padding: 16px; border-bottom: 1px solid #e2e8f0; font-size: 14px; color: #475569;">
                                        <strong style="color: #0f172a; display: inline-block; width: 150px;">Email:</strong>
                                        <a href="mailto:{{ $user->email }}" style="color: #0082c9; text-decoration: underline;">{{ $user->email }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 16px; @if(!empty($user->unique_sequence_number) && $type !== 'forgot') border-bottom: 1px solid #e2e8f0; @endif font-size: 14px; color: #475569;">
                                        <strong style="color: #0f172a; display: inline-block; width: 150px;">Temporary Password:</strong>
                                        <span style="color: #0f172a; font-weight: 600;">{{ $generatedPassword }}</span>
                                    </td>
                                </tr>
                                @if(!empty($user->unique_sequence_number) && $type !== 'forgot')
                                <tr>
                                    <td style="padding: 16px; font-size: 14px; color: #475569;">
                                        <strong style="color: #0f172a; display: inline-block; width: 150px;">VLSID:</strong>
                                        <span style="color: #0f172a; font-weight: 600;">{{ $user->unique_sequence_number }}</span>
                                    </td>
                                </tr>
                                @endif
                            </table>

                            <p style="margin: 0 0 16px; font-size: 14px; line-height: 1.6; color: #475569;">
                                For security, please log in and change your password immediately after your first sign in.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 16px 24px; border-top: 1px solid #f1f5f9; background-color: #fafafa;">
                            <p style="margin: 0; font-size: 13px; line-height: 1.5; color: #64748b;">
                                If you did not request this account, Please contact support@venturacpd.com.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 16px 24px 24px; border-top: 1px solid #f1f5f9;">
                            <p style="margin: 0; font-size: 12px; line-height: 1.7; color: #94a3b8;">
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
