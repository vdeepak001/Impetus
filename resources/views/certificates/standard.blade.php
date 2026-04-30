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
            font-family: 'Times-Roman', serif;
            background-color: #fff;
            color: #000;
        }
        .cert-container {
            width: 297mm;
            height: 210mm;
            padding: 15mm;
            box-sizing: border-box;
            position: relative;
        }
        .outer-border {
            border: 2px solid #000;
            height: 100%;
            width: 100%;
            padding: 5px;
            box-sizing: border-box;
        }
        .inner-border {
            border: 1px solid #000;
            height: 100%;
            width: 100%;
            position: relative;
            box-sizing: border-box;
            padding: 40px;
        }
        
        .top-right-logo {
            position: absolute;
            top: 40px;
            right: 40px;
            text-align: center;
            width: 180px;
        }
        .logo-img {
            height: 70px;
            margin-bottom: 5px;
        }
        .logo-text {
            font-size: 11px;
            font-family: 'Helvetica', sans-serif;
            border: 1px solid #000;
            padding: 5px;
            display: inline-block;
        }

        .content {
            text-align: center;
            margin-top: 80px;
        }
        
        .main-title {
            font-size: 52px;
            font-weight: bold;
            margin-bottom: 40px;
            font-family: 'Times-Bold', serif;
        }
        
        .certify-text {
            font-size: 24px;
            margin-bottom: 25px;
            font-style: italic;
        }
        
        .user-name {
            font-size: 42px;
            color: #ff0000;
            font-weight: bold;
            margin-bottom: 25px;
            font-family: 'Times-Bold', serif;
        }
        
        .completed-text {
            font-size: 22px;
            margin-bottom: 25px;
        }
        
        .course-name {
            font-size: 34px;
            color: #ff0000;
            font-weight: bold;
            margin-bottom: 35px;
            font-family: 'Times-Bold', serif;
        }
        
        .issue-date {
            font-size: 16px;
            margin-bottom: 50px;
        }
        
        .qr-section {
            position: absolute;
            bottom: 140px;
            left: 60px;
            text-align: left;
        }
        .qr-code-box {
            width: 110px;
            height: 110px;
            border: 1px solid #000;
            margin-bottom: 10px;
            padding: 5px;
            background: #fff;
        }
        
        .credit-points-label {
            font-size: 18px;
            font-weight: bold;
            font-family: 'Times-Bold', serif;
        }

        .footer {
            position: absolute;
            bottom: 60px;
            width: 100%;
            left: 0;
            padding: 0 80px;
            box-sizing: border-box;
        }
        
        .footer-table {
            width: 100%;
            border-collapse: collapse;
        }
        .footer-col {
            width: 33.33%;
            vertical-align: bottom;
            text-align: center;
        }
        
        .sig-label {
            font-size: 20px;
            font-weight: bold;
            font-family: 'Times-Bold', serif;
            margin-bottom: 3px;
        }
        .sig-sub-label {
            font-size: 14px;
            font-weight: bold;
        }
        
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 600px;
            margin-left: -300px;
            margin-top: -200px;
            opacity: 0.04;
            z-index: -1;
        }
    </style>
</head>
<body>
    @php
        $userName = $user->name ?: ($user->first_name . ' ' . $user->last_name);
        $rnNumber = $user->rn_number ?? 'N/A';
        $courseNameStr = $course->couse_name;
        
        // QR Data as requested: Name, RN #, Course Name
        $qrData = "Name: " . $userName . "\nRN #: " . $rnNumber . "\nCourse: " . $courseNameStr;
        $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode($qrData);
    @endphp

    <div class="cert-container">
        <div class="outer-border">
            <div class="inner-border">
                <div class="top-right-logo">
                    <img src="{{ public_path('images/venture.svg') }}" class="logo-img">
                    <div class="logo-text">Company Logo<br>(Right Side)</div>
                </div>

                <div class="content">
                    <div class="main-title">Certificate of Completion</div>
                    
                    <div class="certify-text">This is to certify that</div>
                    <div class="user-name">{{ $userName }}</div>
                    
                    <div class="completed-text">has successfully completed the CPD Module</div>
                    <div class="course-name">{{ $courseNameStr }}</div>
                    
                    <div class="issue-date">Issued on this day, {{ $date }}</div>
                </div>

                <div class="qr-section">
                    <div class="qr-code-box">
                        <img src="{{ $qrUrl }}" style="width: 100%; height: 100%;">
                    </div>
                    <div class="credit-points-label">Credit points awarded: {{ $points ?? 0 }}</div>
                </div>

                <div class="footer">
                    <table class="footer-table">
                        <tr>
                            <td class="footer-col" style="text-align: left;">
                                <div class="sig-label">Director</div>
                                <div class="sig-sub-label" style="font-style: italic;">Ventura elearning Solutions</div>
                            </td>
                            <td class="footer-col">
                                <div class="sig-label">Council Name</div>
                            </td>
                            <td class="footer-col" style="text-align: right;">
                                <div class="sig-label">Registrar</div>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="watermark">
                    <img src="{{ public_path('images/venture.svg') }}" style="width: 100%;">
                </div>
            </div>
        </div>
    </div>
</body>
</html>
