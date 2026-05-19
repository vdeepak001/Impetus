<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Certificate of Completion</title>
    <style>
        @page {
            margin: 0px;
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
            background-color: transparent;
            color: #1e293b;
        }
        .cert-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1000;
        }
        .cert-container {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            box-sizing: border-box;
            background-color: transparent;
        }
        .cert-content {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            padding: 30px 45px;
            box-sizing: border-box;
            background-color: transparent;
        }
        .inner-frame {
            position: absolute;
            top: 30px;
            left: 45px;
            right: 45px;
            bottom: 30px;
            padding: 20px 30px;
            box-sizing: border-box;
            text-align: center;
        }
        
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .header-left {
            width: 30%;
            text-align: left;
            vertical-align: top;
        }
        .header-right {
            width: 30%;
            text-align: right;
            vertical-align: top;
        }
        .logo {
            height: 80px;
            max-width: 200px;
        }
        .logo-placeholder {
            width: 180px;
            height: 80px;
            border: 1px dashed #cbd5e1;
            display: inline-block;
            line-height: 80px;
            font-size: 10px;
            color: #94a3b8;
            text-align: center;
        }
        
        .main-title {
            font-size: 44px;
            color: #0f172a;
            text-transform: none;
            margin: 5px 0;
            font-weight: bold;
            font-family: 'Times-Bold', serif;
        }
        
        .certify-text {
            font-size: 22px;
            margin: 15px 0 10px;
            color: #475569;
        }
        .user-name {
            font-size: 40px;
            color: #0082c9; /* Logo blue */
            font-weight: bold;
            margin: 5px 0;
            font-family: 'Times-BoldItalic', serif;
            display: inline-block;
            padding: 0 40px;
        }
        
        .course-label {
            font-size: 20px;
            margin: 15px 0 5px;
            color: #475569;
        }
        .course-name {
            font-size: 32px;
            color: #5a8b3d; /* Dark Green */
            font-weight: bold;
            margin-bottom: 15px;
            max-width: 85%;
            margin-left: auto;
            margin-right: auto;
        }
        
        .date-section {
            font-size: 16px;
            margin: 10px 0;
            color: #64748b;
        }
        
        .points-section {
            font-size: 22px;
            font-weight: bold;
            color: #0f172a;
            margin: 25px 0;
        }
        
        .footer-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        .footer-cell {
            width: 33.33%;
            vertical-align: bottom;
            text-align: center;
        }
        .sig-label {
            font-size: 18px;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 2px;
        }
        .sig-sub-label {
            font-size: 12px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .qr-box {
            display: inline-block;
            padding: 5px;
            border: 1px solid #e2e8f0;
            background: #fff;
        }
        .qr-img {
            width: 100px;
            height: 100px;
            display: block;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 480px;
            height: 480px;
            margin-left: -240px;
            margin-top: -240px;
            opacity: 0.03;
            z-index: -100;
        }
    </style>
</head>
<body>
    @php
        $salutation = '';
        if ($user->gender) {
            $gender = strtolower($user->gender);
            if ($gender === 'male') {
                $salutation = 'Mr. ';
            } elseif ($gender === 'female') {
                $salutation = 'Ms. ';
            }
        }
        $userName = $salutation . ($user->name ?: ($user->first_name . ' ' . $user->last_name));
        $courseNameStr = $course->couse_name;
        
        // QR Data
        $qrData = "User ID: " . ($user->unique_sequence_number ?? 'N/A') . "\nModule: " . $courseNameStr . "\nDate: " . $date;
        $qrUrl = "https://quickchart.io/qr?text=" . rawurlencode($qrData) . "&size=200";
        
        // Fetch and encode image to ensure it shows in PDF
        try {
            $qrContext = stream_context_create([
                'http' => ['timeout' => 5],
                'ssl'  => ['verify_peer' => false, 'verify_peer_name' => false]
            ]);
            $qrContent = @file_get_contents($qrUrl, false, $qrContext);
            if ($qrContent) {
                $qrUrl = 'data:image/png;base64,' . base64_encode($qrContent);
            }
        } catch (\Exception $e) {}

        $stateCouncil = null;
        if ($user->state) {
            $stateCouncil = \App\Models\StateCouncil::whereHas('state', function($q) use ($user) {
                $q->where('name', trim($user->state));
            })->first();
        }
        if (!$stateCouncil) {
            $stateCouncil = $order->stateCouncil;
        }

        $councilName = $stateCouncil ? $stateCouncil->council_name : 'State Nursing Council';
        $councilLogo = null;
        if ($stateCouncil && $stateCouncil->logo) {
            $logoPath = storage_path('app/public/' . $stateCouncil->logo);
            if (file_exists($logoPath)) {
                $councilLogo = 'data:image/' . pathinfo($logoPath, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($logoPath));
            }
        }

        // Dynamically compute points based on the resolved state council
        if ($stateCouncil) {
            $pivot = \Illuminate\Support\Facades\DB::table('course_detail_state_council')
                ->where('course_detail_id', $order->course_detail_id)
                ->where('state_council_id', $stateCouncil->id)
                ->first();
            if ($pivot) {
                $p = json_decode($pivot->points, true);
                $points = is_array($p) ? ($p[0] ?? 0) : ($p ?? 0);
            }
        }
    @endphp

    <div class="cert-background">
        <img src="{{ public_path('images/A4 Certificate.png') }}" style="width: 100%; height: 100%; display: block;" />
    </div>

    <div class="watermark">
        <img src="{{ public_path('images/venture.svg') }}" style="width: 100%; height: auto; display: block;" />
    </div>

    <div class="cert-container">
        <div class="cert-content">
            <div class="inner-frame">
                <!-- Spacer to push the title down below the top-left background logo and top curves -->
                <div style="height: 80px;"></div>

                <div class="main-title">Certificate of Completion</div>

                <div class="certify-text">This is to certify that</div>
                <div class="user-name">{{ $userName }}</div>

                <div class="course-label">has successfully completed the CPD Module</div>
                <div class="course-name">{{ $courseNameStr }}</div>

                <div class="date-section">
                    Issued on this day, {{ $date }}
                </div>

                <div class="points-section">
                    Credit Points Awarded: {{ $points ?? 0 }}
                </div>

                <table class="footer-table">
                    <tr>
                        <td class="footer-cell">
                            <div class="sig-label">Registrar</div>
                            <div class="sig-sub-label">{{ $councilName }}</div>
                        </td>
                        <td class="footer-cell">
                            <div class="qr-box">
                                <img src="{{ $qrUrl }}" class="qr-img">
                            </div>
                        </td>
                        <td class="footer-cell">
                            <div class="sig-label">Director</div>
                            <div class="sig-sub-label">Ventura Learning Solutions</div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
