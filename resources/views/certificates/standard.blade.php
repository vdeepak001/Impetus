<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Certificate of Completion</title>
    <style>
        @page {
            margin: 0;
            size: A4 landscape;
        }
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }
        body {
            font-family: 'serif';
            background-color: #fff;
            color: #1e293b;
        }
        .cert-container {
            width: 297mm;
            height: 210mm;
            padding: 10mm;
            box-sizing: border-box;
            background-color: #f1f5f9;
        }
        .cert-content {
            border: 10px double #0f172a;
            height: 190mm;
            padding: 15px;
            box-sizing: border-box;
            background-color: #fff;
            position: relative;
        }
        .inner-frame {
            border: 1px solid #b45309;
            height: 100%;
            padding: 30px;
            box-sizing: border-box;
            position: relative;
            text-align: center;
        }
        
        /* Decorative Corners */
        .corner {
            position: absolute;
            width: 60px;
            height: 60px;
            border: 3px solid #b45309;
            z-index: 10;
        }
        .tl { top: -5px; left: -5px; border-right: 0; border-bottom: 0; }
        .tr { top: -5px; right: -5px; border-left: 0; border-bottom: 0; }
        .bl { bottom: -5px; left: -5px; border-right: 0; border-top: 0; }
        .br { bottom: -5px; right: -5px; border-left: 0; border-top: 0; }

        .header {
            margin-bottom: 20px;
        }
        .logo {
            height: 70px;
        }
        
        .main-title {
            font-size: 54px;
            color: #0f172a;
            letter-spacing: 10px;
            text-transform: uppercase;
            margin: 10px 0;
            font-weight: bold;
            font-family: 'Times-Bold', serif;
        }
        .sub-title {
            font-size: 18px;
            color: #b45309;
            font-style: italic;
            margin-bottom: 30px;
            letter-spacing: 3px;
        }
        
        .certify-text {
            font-size: 20px;
            margin-bottom: 10px;
            color: #475569;
        }
        .user-name {
            font-size: 48px;
            color: #0f172a;
            font-weight: bold;
            margin: 10px 0;
            font-family: 'Times-BoldItalic', serif;
            border-bottom: 2px solid #e2e8f0;
            display: inline-block;
            padding: 0 50px;
        }
        
        .course-label {
            font-size: 20px;
            margin: 25px 0 10px;
            color: #475569;
        }
        .course-name {
            font-size: 34px;
            color: #0f172a;
            font-weight: bold;
            margin-bottom: 30px;
            max-width: 85%;
            margin-left: auto;
            margin-right: auto;
        }
        
        .date-section {
            font-size: 16px;
            margin-top: 15px;
            color: #64748b;
        }
        
        .footer-table {
            width: 100%;
            margin-top: 40px;
            border-collapse: collapse;
        }
        .footer-cell {
            width: 33.33%;
            vertical-align: bottom;
            text-align: center;
        }
        .sig-line {
            width: 180px;
            border-bottom: 1px solid #0f172a;
            margin: 0 auto 10px;
            height: 40px;
        }
        .sig-label {
            font-size: 12px;
            font-weight: bold;
            color: #1e293b;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .qr-section {
            position: absolute;
            bottom: 40px;
            left: 40px;
            text-align: left;
            z-index: 20;
        }
        .qr-box {
            background: #fff;
            padding: 5px;
            border: 1px solid #e2e8f0;
            display: inline-block;
        }
        .qr-img {
            width: 85px;
            height: 85px;
            display: block;
        }
        .qr-text {
            font-size: 9px;
            color: #94a3b8;
            margin-top: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 450px;
            margin-left: -225px;
            margin-top: -225px;
            opacity: 0.04;
            z-index: -1;
        }
    </style>
</head>
<body>
    @php
        $userName = $user->name ?: ($user->first_name . ' ' . $user->last_name);
        $courseNameStr = $course->couse_name;
        
        // Simplified QR data for better scanning reliability
        $qrData = "Name: $userName | Course: $courseNameStr";
        $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode($qrData);
    @endphp

    <div class="cert-container">
        <div class="cert-content">
            <div class="inner-frame">
                <div class="corner tl"></div>
                <div class="corner tr"></div>
                <div class="corner bl"></div>
                <div class="corner br"></div>

                <div class="header">
                    <img src="{{ public_path('images/venture.svg') }}" class="logo">
                </div>

                <div class="main-title">Certificate</div>
                <div class="sub-title">OF COMPLETION AND EXCELLENCE</div>

                <div class="certify-text">This is to certify that</div>
                <div class="user-name">{{ $userName }}</div>

                <div class="course-label">has successfully mastered the CPD module</div>
                <div class="course-name">{{ $courseNameStr }}</div>

                <div class="date-section">
                    Issued on this day, {{ $date }}
                </div>

                <table class="footer-table">
                    <tr>
                        <td class="footer-cell">
                            <div class="sig-line"></div>
                            <div class="sig-label">PROGRAM COORDINATOR</div>
                        </td>
                        <td class="footer-cell">
                            <div style="height: 40px; margin-bottom: 10px;">
                                <img src="{{ public_path('images/venture.svg') }}" style="height: 35px; opacity: 0.5;">
                            </div>
                            <div class="sig-label">VENTURE LEARNING</div>
                        </td>
                        <td class="footer-cell">
                            <div class="sig-line"></div>
                            <div class="sig-label">MEDICAL DIRECTOR</div>
                        </td>
                    </tr>
                </table>

                <div class="watermark">
                    <img src="{{ public_path('images/venture.svg') }}" style="width: 100%;">
                </div>
            </div>

            <!-- QR Section moved outside inner-frame to avoid text overlap issues in some rendering engines -->
            <div class="qr-section">
                <div class="qr-box">
                    <img src="{{ $qrUrl }}" class="qr-img">
                </div>
                <div class="qr-text">Scan to Verify</div>
            </div>
        </div>
    </div>
</body>
</html>
