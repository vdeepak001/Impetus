<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Certificate of Completion</title>
    <style>
        @page {
            margin: 0;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f8fdf9;
        }
        .certificate-container {
            width: 100%;
            height: 100%;
            padding: 40px;
            box-sizing: border-box;
            position: relative;
        }
        .border-outer {
            border: 15px solid #1a365d; /* logo-blue-ish */
            height: 90%;
            padding: 10px;
            position: relative;
        }
        .border-inner {
            border: 2px solid #5fb143; /* logo-light-green */
            height: 100%;
            padding: 40px;
            box-sizing: border-box;
            text-align: center;
            background-color: white;
            background-image: radial-gradient(#5fb14310 1px, transparent 1px);
            background-size: 20px 20px;
        }
        .logo {
            margin-bottom: 20px;
        }
        .logo img {
            height: 60px;
        }
        .certificate-title {
            font-size: 48px;
            font-weight: bold;
            color: #1a365d;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .certificate-subtitle {
            font-size: 18px;
            color: #555;
            margin-bottom: 40px;
            font-style: italic;
        }
        .certify-text {
            font-size: 20px;
            margin-bottom: 10px;
        }
        .user-name {
            font-size: 42px;
            font-weight: bold;
            color: #1a365d;
            margin-bottom: 20px;
            border-bottom: 2px solid #5fb143;
            display: inline-block;
            padding: 0 40px;
        }
        .course-text {
            font-size: 20px;
            margin-bottom: 10px;
        }
        .course-name {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin-bottom: 30px;
        }
        .points-box {
            display: inline-block;
            background-color: #1a365d;
            color: white;
            padding: 10px 25px;
            border-radius: 50px;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 40px;
        }
        .footer {
            margin-top: 50px;
            width: 100%;
        }
        .signature-container {
            width: 100%;
            display: table;
        }
        .signature-box {
            display: table-cell;
            width: 33%;
            text-align: center;
            vertical-align: bottom;
        }
        .signature-line {
            width: 150px;
            border-top: 1px solid #333;
            margin: 0 auto 5px;
        }
        .signature-label {
            font-size: 14px;
            font-weight: bold;
            color: #555;
        }
        .date-box {
            margin-top: 20px;
            font-size: 16px;
            color: #777;
        }
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.03;
            z-index: -1;
        }
        .watermark img {
            width: 500px;
        }
        .seal {
            position: absolute;
            bottom: 60px;
            right: 80px;
            width: 120px;
            height: 120px;
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="certificate-container">
        <div class="border-outer">
            <div class="border-inner">
                <div class="watermark">
                    <img src="{{ public_path('images/logo/logo-impetus.png') }}" alt="">
                </div>

                <div class="logo">
                    <img src="{{ public_path('images/logo/logo-impetus.png') }}" alt="Impetus Logo">
                </div>

                <div class="certificate-title">Certificate</div>
                <div class="certificate-subtitle">OF COMPLETION</div>

                <div class="certify-text">This is to certify that</div>
                <div class="user-name">{{ $user->name ?: ($user->first_name . ' ' . $user->last_name) }}</div>

                <div class="course-text">has successfully completed the CPD module</div>
                <div class="course-name">{{ $course->couse_name }}</div>

                @if(($points ?? 0) > 0)
                    <div class="points-box">
                        {{ $points }} CREDIT {{ $points > 1 ? 'POINTS' : 'POINT' }}
                    </div>
                @endif

                <div class="date-box">
                    Awarded on <strong>{{ $date }}</strong>
                </div>

                <div class="footer">
                    <div class="signature-container">
                        <div class="signature-box">
                            <div class="signature-line"></div>
                            <div class="signature-label">Program Coordinator</div>
                        </div>
                        <div class="signature-box">
                            <!-- Placeholder for a seal or central signature -->
                             <div style="height: 40px;"></div>
                             <div class="signature-label">Impetus Learning</div>
                        </div>
                        <div class="signature-box">
                            <div class="signature-line"></div>
                            <div class="signature-label">Medical Director</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
