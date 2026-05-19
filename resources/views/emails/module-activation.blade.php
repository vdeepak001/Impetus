<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CPD Module Activated</title>
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
                            <h1 style="margin: 0; color: #ffffff; font-size: 24px; line-height: 1.3; font-weight: 700;">
                                CPD Module Activated!
                            </h1>
                            <p style="margin: 8px 0 0; color: #f8fafc; font-size: 14px; line-height: 1.6;">
                                Your access to the module has been successfully enabled.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 24px;">
                            <p style="margin: 0 0 16px; font-size: 15px; line-height: 1.7; color: #334155;">
                                Hello {{ $user->name }},
                            </p>
                            <p style="margin: 0 0 20px; font-size: 15px; line-height: 1.7; color: #334155;">
                                We are pleased to inform you that your state-assigned CPD module <strong>{{ $course->couse_name }}</strong> has been activated by the administrator. You can now login to your portal and start learning!
                            </p>

                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border: 1px solid #e2e8f0; border-radius: 12px; background-color: #f8fafc; margin-bottom: 24px;">
                                <tr>
                                    <td style="padding: 16px 20px;">
                                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td style="padding-bottom: 8px; font-size: 13px; color: #64748b; width: 40%;">Module Name</td>
                                                <td style="padding-bottom: 8px; font-size: 14px; font-weight: 600; color: #1e293b;">{{ $course->couse_name }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding-bottom: 8px; font-size: 13px; color: #64748b;">Activation Date</td>
                                                <td style="padding-bottom: 8px; font-size: 14px; font-weight: 600; color: #1e293b;">{{ $order->start_date ? \Carbon\Carbon::parse($order->start_date)->format('d-m-Y') : '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding-bottom: 8px; font-size: 13px; color: #64748b;">Expiry Date</td>
                                                <td style="padding-bottom: 8px; font-size: 14px; font-weight: 600; color: #1e293b;">{{ $order->end_date ? \Carbon\Carbon::parse($order->end_date)->format('d-m-Y') : '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 13px; color: #64748b;">Payment Mode</td>
                                                <td style="font-size: 14px; font-weight: 600; color: #1e293b;">{{ \App\Enums\PaymentMode::tryFrom($order->payment_mode)?->label() ?? $order->payment_mode }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="center" style="padding: 10px 0 20px;">
                                        <a href="{{ url('/') }}" style="display: inline-block; padding: 12px 32px; background-color: #0082c9; color: #ffffff; font-size: 15px; font-weight: 600; text-decoration: none; border-radius: 10px; box-shadow: 0 4px 6px -1px rgba(0, 130, 201, 0.2), 0 2px 4px -1px rgba(0, 130, 201, 0.1); transition: background-color 0.2s;">
                                            Go to Dashboard
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin: 10px 0 0; font-size: 14px; line-height: 1.7; color: #475569;">
                                If you have any questions or require assistance, please feel free to contact our support team.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 16px 24px 24px; border-top: 1px solid #f1f5f9;">
                            <p style="margin: 0; font-size: 12px; line-height: 1.7; color: #64748b;">
                                &copy; {{ date('Y') }} {{ config('app.name', 'Impetus') }}. All rights reserved.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
