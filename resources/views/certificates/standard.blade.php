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
        body {
            font-family: 'serif';
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #1e293b;
            overflow: hidden;
        }
        .cert-wrapper {
            padding: 20px;
            height: 750px;
            box-sizing: border-box;
            background-color: #f8fafc;
            overflow: hidden;
        }
        .outer-border {
            border: 10px double #0f172a;
            height: 100%;
            padding: 5px;
            box-sizing: border-box;
            background-color: #fff;
        }
        .inner-border {
            border: 1.5px solid #b45309;
            height: 100%;
            padding: 20px 40px;
            box-sizing: border-box;
            background-color: #ffffff;
            position: relative;
            text-align: center;
        }
        
        /* Decorative Corners */
        .corner {
            position: absolute;
            width: 60px;
            height: 60px;
            border: 3px solid #b45309;
        }
        .tl { top: -5px; left: -5px; border-right: 0; border-bottom: 0; }
        .tr { top: -5px; right: -5px; border-left: 0; border-bottom: 0; }
        .bl { bottom: -5px; left: -5px; border-right: 0; border-top: 0; }
        .br { bottom: -5px; right: -5px; border-left: 0; border-top: 0; }

        .header {
            margin-bottom: 15px;
        }
        .logo {
            height: 65px;
            margin-bottom: 10px;
        }
        
        .main-title {
            font-size: 48px;
            color: #0f172a;
            letter-spacing: 8px;
            text-transform: uppercase;
            margin: 5px 0;
            font-weight: bold;
            font-family: 'Times-Bold', serif;
        }
        .sub-title {
            font-size: 16px;
            color: #b45309;
            font-style: italic;
            margin-bottom: 20px;
            letter-spacing: 2px;
        }
        
        .certify-text {
            font-size: 18px;
            margin-bottom: 5px;
            color: #475569;
        }
        .user-name {
            font-size: 42px;
            color: #0f172a;
            font-weight: bold;
            margin: 5px 0;
            font-family: 'Times-BoldItalic', serif;
            border-bottom: 1px solid #e2e8f0;
            display: inline-block;
            padding: 0 40px;
        }
        
        .course-label {
            font-size: 18px;
            margin: 20px 0 8px;
            color: #475569;
        }
        .course-name {
            font-size: 30px;
            color: #0f172a;
            font-weight: bold;
            margin-bottom: 20px;
            max-width: 80%;
            margin-left: auto;
            margin-right: auto;
        }
        
        .points-badge {
            display: inline-block;
            border: 2px solid #0f172a;
            color: #0f172a;
            padding: 8px 30px;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 25px;
            text-transform: uppercase;
        }
        
        .date-section {
            font-size: 16px;
            margin-top: 10px;
            color: #64748b;
        }
        
        .footer {
            margin-top: 25px;
            width: 100%;
        }
        .sig-row {
            display: block;
            width: 100%;
            clear: both;
        }
        .sig-col {
            float: left;
            width: 33.33%;
            text-align: center;
        }
        .sig-line {
            width: 180px;
            border-bottom: 1px solid #0f172a;
            margin: 0 auto 8px;
            height: 45px;
        }
        .sig-label {
            font-size: 13px;
            font-weight: bold;
            color: #1e293b;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 400px;
            height: 400px;
            margin-left: -200px;
            margin-top: -200px;
            opacity: 0.04;
            z-index: -1;
        }
    </style>
</head>
<body>
    <div class="cert-wrapper">
        <div class="outer-border">
            <div class="inner-border">
                <div class="corner tl"></div>
                <div class="corner tr"></div>
                <div class="corner bl"></div>
                <div class="corner br"></div>

                <div class="header">
                    <img src="{{ public_path('images/venture.svg') }}" class="logo" style="height: 55px;">
                </div>

                <div class="main-title">Certificate</div>
                <div class="sub-title">OF COMPLETION AND EXCELLENCE</div>

                <div class="certify-text">This is to certify that</div>
                <div class="user-name">{{ $user->name ?: ($user->first_name . ' ' . $user->last_name) }}</div>

                <div class="course-label">has successfully mastered the CPD module</div>
                <div class="course-name">{{ $course->couse_name }}</div>

                @if(($points ?? 0) > 0)
                    <div class="points-badge">
                        AWARDED {{ $points }} CPD CREDIT {{ $points > 1 ? 'POINTS' : 'POINT' }}
                    </div>
                @endif

                <div class="date-section">
                    Issued on this day, {{ $date }}
                </div>

                <div class="footer">
                    <div class="sig-row">
                        <div class="sig-col">
                            <div class="sig-line"></div>
                            <div class="sig-label">PROGRAM COORDINATOR</div>
                        </div>
                        <div class="sig-col">
                            <div style="height: 45px;">
                                <img src="{{ public_path('images/venture.svg') }}" style="height: 35px; opacity: 0.5;">
                            </div>
                            <div class="sig-label">VENTURE LEARNING</div>
                        </div>
                        <div class="sig-col">
                            <div class="sig-line"></div>
                            <div class="sig-label">MEDICAL DIRECTOR</div>
                        </div>
                    </div>
                </div>
                
                <div class="watermark">
                    <img src="{{ public_path('images/venture.svg') }}" style="width: 100%;">
                </div>
            </div>
        </div>
    </div>
</body>
</html>
