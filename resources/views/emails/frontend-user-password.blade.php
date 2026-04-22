<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to {{ config('app.name', 'Impetus') }}</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f8fafc; font-family: Inter, Arial, sans-serif; color: #1e293b;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #f8fafc; padding: 24px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width: 620px; background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 18px; overflow: hidden;">
                    <tr>
                        <td align="center" style="padding: 24px 24px 16px;">
                            <img src="{{ asset('images/venture.svg') }}" alt="Venture Logo" style="height: 40px; width: auto; display: block;">
                        </td>
                    </tr>
                    <tr>
                        <td style="background: linear-gradient(135deg, #0082c9 0%, #83ba2d 100%); padding: 24px;">
                            <h1 style="margin: 0; color: #ffffff; font-size: 24px; line-height: 1.3; font-weight: 700;">
                                Welcome, {{ $user->name }}!
                            </h1>
                            <p style="margin: 8px 0 0; color: #f8fafc; font-size: 14px; line-height: 1.6;">
                                Your account has been created successfully.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 24px;">
                            <p style="margin: 0 0 16px; font-size: 15px; line-height: 1.7; color: #334155;">
                                Here are your login details:
                            </p>

                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border: 1px solid #e2e8f0; border-radius: 12px; background-color: #f8fafc;">
                                <tr>
                                    <td style="padding: 14px 16px; border-bottom: 1px solid #e2e8f0; font-size: 14px; color: #475569;">
                                        <strong style="color: #0f172a;">Email:</strong> {{ $user->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 14px 16px; font-size: 14px; color: #475569;">
                                        <strong style="color: #0f172a;">Temporary Password:</strong> {{ $generatedPassword }}
                                    </td>
                                </tr>
                            </table>

                            <p style="margin: 20px 0 0; font-size: 14px; line-height: 1.7; color: #475569;">
                                For security, please log in and change your password immediately after your first sign in.
                            </p>

                            {{-- <table role="presentation" cellspacing="0" cellpadding="0" style="margin-top: 22px;">
                                <tr>
                                    <td>
                                        <a href="{{ route('login') }}" style="display: inline-block; padding: 11px 18px; border-radius: 999px; background-color: #0082c9; color: #ffffff; text-decoration: none; font-size: 14px; font-weight: 600;">
                                            Log In Now
                                        </a>
                                    </td>
                                </tr>
                            </table> --}}
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 16px 24px 24px; border-top: 1px solid #f1f5f9;">
                            <p style="margin: 0; font-size: 12px; line-height: 1.7; color: #64748b;">
                                If you did not request this account, please contact support immediately.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
