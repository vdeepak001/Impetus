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
            width: 280mm; /* Further reduced to ensure all borders are visible on all printers/viewers */
            height: 200mm;
            padding: 5mm;
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
            padding: 20px;
            box-sizing: border-box;
            position: relative;
            text-align: center;
        }
        
        .corner {
            position: absolute;
            width: 60px;
            height: 60px;
            border: 3px solid #b45309;
            z-index: 100;
        }
        .tl { top: -5px; left: -5px; border-right: 0; border-bottom: 0; }
        .tr { top: -5px; right: -5px; border-left: 0; border-bottom: 0; }
        .bl { bottom: -5px; left: -5px; border-right: 0; border-top: 0; }
        .br { bottom: -5px; right: -5px; border-left: 0; border-top: 0; }

        /* Header Table for alignment */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .header-left {
            width: 20%;
            text-align: left;
            vertical-align: top;
        }
        .header-middle {
            width: 60%;
            text-align: center;
            vertical-align: top;
        }
        .header-right {
            width: 20%;
        }

        .qr-box {
            background: #fff;
            padding: 4px;
            border: 1px solid #e2e8f0;
            display: inline-block;
            text-align: center;
        }
        .qr-img {
            width: 100px;
            height: 100px;
            display: block;
        }
        .qr-text {
            font-size: 8px;
            color: #94a3b8;
            margin-top: 3px;
            text-transform: uppercase;
        }

        .logo {
            height: 75px;
        }
        
        .main-title {
            font-size: 54px;
            color: #0f172a;
            letter-spacing: 10px;
            text-transform: uppercase;
            margin: 5px 0;
            font-weight: bold;
            font-family: 'Times-Bold', serif;
        }
        .sub-title {
            font-size: 18px;
            color: #b45309;
            font-style: italic;
            margin-bottom: 25px;
            letter-spacing: 3px;
        }
        
        .certify-text {
            font-size: 20px;
            margin-bottom: 5px;
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
            margin: 25px 0 8px;
            color: #475569;
        }
        .course-name {
            font-size: 34px;
            color: #0f172a;
            font-weight: bold;
            margin-bottom: 20px;
            max-width: 85%;
            margin-left: auto;
            margin-right: auto;
        }
        
        .date-section {
            font-size: 16px;
            margin-top: 10px;
            color: #64748b;
        }
        
        .footer-table {
            width: 100%;
            margin-top: 30px;
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
            height: 35px;
        }
        .sig-label {
            font-size: 11px;
            font-weight: bold;
            color: #1e293b;
            text-transform: uppercase;
            letter-spacing: 1px;
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
        
        $qrData = "Name: $userName\nCourse: $courseNameStr";
        $qrUrl = "https://quickchart.io/qr?text=" . urlencode($qrData) . "&size=150";
        
        // Fetch and encode image to ensure it shows in PDF
        try {
            $qrContext = stream_context_create([
                'http' => ['timeout' => 5],
                'ssl'  => ['verify_peer' => false, 'verify_peer_name' => false] // Bypass SSL issues on local servers
            ]);
            $qrContent = @file_get_contents($qrUrl, false, $qrContext);
            if ($qrContent) {
                $qrUrl = 'data:image/png;base64,' . base64_encode($qrContent);
            }
        } catch (\Exception $e) {
            // Fallback to original URL
        }
    @endphp

    <div class="cert-container">
        <div class="cert-content">
            <div class="inner-frame">
                <div class="corner tl"></div>
                <div class="corner tr"></div>
                <div class="corner bl"></div>
                <div class="corner br"></div>

                <table class="header-table">
                    <tr>
                        <td class="header-left">
                            <div class="qr-box">
                                <img src="{{ $qrUrl }}" class="qr-img">
                                <div class="qr-text">Scan to Verify</div>
                            </div>
                        </td>
                        <td class="header-middle">
                            <img src="{{ public_path('images/venture.svg') }}" class="logo">
                        </td>
                        <td class="header-right">
                            <!-- Empty right side for balance -->
                        </td>
                    </tr>
                </table>

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
                            <div style="height: 35px; margin-bottom: 10px;">
                                <img src="{{ public_path('images/venture.svg') }}" style="height: 30px; opacity: 0.5;">
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
        </div>
    </div>
</body>
</html>
