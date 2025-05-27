<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Bank Account Application - {{ $bankAccount->id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            line-height: 1.5;
            color: #333;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #0064a7;
            padding-bottom: 15px;
        }
        .header h2 {
            color: #0064a7;
            margin-bottom: 5px;
        }
        .header .subtitle {
            color: #666;
            font-size: 16px;
        }
        .section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }
        .section-title {
            background-color: #f5f5f5;
            padding: 8px 12px;
            border-left: 4px solid #0064a7;
            margin-bottom: 15px;
            font-weight: bold;
            color: #0064a7;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px 10px;
        }
        .field {
            flex: 0 0 33.33%;
            padding: 0 10px;
            margin-bottom: 12px;
        }
        .label {
            font-weight: 600;
            font-size: 13px;
            color: #555;
            margin-bottom: 3px;
        }
        .value {
            padding: 6px 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 3px;
            min-height: 32px;
            word-break: break-word;
        }
        .empty-value {
            color: #999;
            font-style: italic;
        }
        .signature-container {
            display: flex;
            gap: 30px;
            margin-top: 20px;
        }
        .signature-box {
            flex: 1;
            text-align: center;
        }
        .signature-image {
            max-width: 200px;
            max-height: 100px;
            border: 1px solid #ddd;
            margin-bottom: 5px;
        }
        @media (max-width: 768px) {
            .field {
                flex: 0 0 50%;
            }
        }
        @media (max-width: 480px) {
            .field {
                flex: 0 0 100%;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>Bank Account Application</h2>
        <div class="subtitle">Application ID: {{ $bankAccount->id }}</div>
    </div>

    <!-- Applicant Information Section -->
    <div class="section">
        <div class="section-title">1. Applicant Information</div>
        <div class="row">
            <div class="field">
                <div class="label">Applicant Type</div>
                <div class="value">{{ $bankAccount->applicantType ?? '<span class="empty-value">Not provided</span>' }}</div>
            </div>
            <div class="field">
                <div class="label">Salutation</div>
                <div class="value">{{ $bankAccount->salutation ?? '<span class="empty-value">Not provided</span>' }}</div>
            </div>
            <div class="field">
                <div class="label">Nepali Citizen</div>
                <div class="value">{{ isset($bankAccount->nepaleseCitizen) ? ($bankAccount->nepaleseCitizen ? 'Yes' : 'No') : '<span class="empty-value">Not provided</span>' }}</div>
            </div>
            <div class="field">
                <div class="label">Purpose</div>
                <div class="value">{{ $bankAccount->applicantPurpose ?? '<span class="empty-value">Not provided</span>' }}</div>
            </div>
            <div class="field">
                <div class="label">Preferred Bank</div>
                <div class="value">{{ $bankAccount->preferredBank ?? '<span class="empty-value">Not provided</span>' }}</div>
            </div>
            <div class="field">
                <div class="label">Branch</div>
                <div class="value">{{ $bankAccount->branch ?? '<span class="empty-value">Not provided</span>' }}</div>
            </div>
        </div>
    </div>

    <!-- Personal Details Section -->
    <div class="section">
        <div class="section-title">2. Personal Details</div>
        <div class="row">
            <div class="field">
                <div class="label">Full Name</div>
                <div class="value">
                    {{ $bankAccount->firstName ?? '' }} 
                    {{ $bankAccount->middleName ? ' '.$bankAccount->middleName : '' }} 
                    {{ $bankAccount->lastName ?? '' }}
                    @if(empty($bankAccount->firstName) )
                        <span class="empty-value">Not provided</span>
                    @endif
                </div>
            </div>
            <div class="field">
                <div class="label">Mobile Number</div>
                <div class="value">{{ $bankAccount->mobileNumber ?? '<span class="empty-value">Not provided</span>' }}</div>
            </div>
            <div class="field">
                <div class="label">Phone Number</div>
                <div class="value">{{ $bankAccount->phoneNumber ?? '<span class="empty-value">Not provided</span>' }}</div>
            </div>
            <div class="field">
                <div class="label">Email</div>
                <div class="value">{{ $bankAccount->email ?? '<span class="empty-value">Not provided</span>' }}</div>
            </div>
            <div class="field">
                <div class="label">Date of Birth (BS)</div>
                <div class="value">{{ $bankAccount->nepaliDob ?? '<span class="empty-value">Not provided</span>' }}</div>
            </div>
            <div class="field">
                <div class="label">Date of Birth (AD)</div>
                <div class="value">
                    @if($bankAccount->englishDob)
                        {{ \Carbon\Carbon::parse($bankAccount->englishDob)->format('Y-m-d') }}
                    @else
                        <span class="empty-value">Not provided</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Family Details Section -->
    <div class="section">
        <div class="section-title">3. Family Details</div>
        <div class="row">
            <div class="field">
                <div class="label">Father's Name</div>
                <div class="value">{{ $bankAccount->fatherName ?? '<span class="empty-value">Not provided</span>' }}</div>
            </div>
            <div class="field">
                <div class="label">Mother's Name</div>
                <div class="value">{{ $bankAccount->motherName ?? '<span class="empty-value">Not provided</span>' }}</div>
            </div>
            <div class="field">
                <div class="label">Grandfather's Name</div>
                <div class="value">{{ $bankAccount->grandfatherName ?? '<span class="empty-value">Not provided</span>' }}</div>
            </div>
            <div class="field">
                <div class="label">Spouse Name</div>
                <div class="value">{{ $bankAccount->spouse ?? '<span class="empty-value">Not applicable</span>' }}</div>
            </div>
        </div>
    </div>

    <!-- Address Section -->
    <div class="section">
        <div class="section-title">4. Address Details</div>
        
        <div class="sub-section" style="margin-bottom: 20px;">
            <h4 style="margin-bottom: 10px; color: #444;">Permanent Address</h4>
            <div class="row">
                <div class="field">
                    <div class="label">Country</div>
                    <div class="value">{{ $bankAccount->permanentCountry ?? '<span class="empty-value">Not provided</span>' }}</div>
                </div>
                <div class="field">
                    <div class="label">Province</div>
                    <div class="value">{{ $bankAccount->permanentProvince ?? '<span class="empty-value">Not provided</span>' }}</div>
                </div>
                <div class="field">
                    <div class="label">District</div>
                    <div class="value">{{ $bankAccount->permanentDistrict ?? '<span class="empty-value">Not provided</span>' }}</div>
                </div>
                <div class="field">
                    <div class="label">Municipality</div>
                    <div class="value">{{ $bankAccount->permanentMunicipality ?? '<span class="empty-value">Not provided</span>' }}</div>
                </div>
                <div class="field">
                    <div class="label">Ward No</div>
                    <div class="value">{{ $bankAccount->permanentWardNo ?? '<span class="empty-value">Not provided</span>' }}</div>
                </div>
                <div class="field">
                    <div class="label">Tole</div>
                    <div class="value">{{ $bankAccount->permanentTole ?? '<span class="empty-value">Not provided</span>' }}</div>
                </div>
            </div>
        </div>

        @if(!$bankAccount->sameAsPermanent)
        <div class="sub-section">
            <h4 style="margin-bottom: 10px; color: #444;">Temporary Address</h4>
            <div class="row">
                <div class="field">
                    <div class="label">Country</div>
                    <div class="value">{{ $bankAccount->temporaryCountry ?? '<span class="empty-value">Not provided</span>' }}</div>
                </div>
                <div class="field">
                    <div class="label">Province</div>
                    <div class="value">{{ $bankAccount->temporaryProvince ?? '<span class="empty-value">Not provided</span>' }}</div>
                </div>
                <div class="field">
                    <div class="label">District</div>
                    <div class="value">{{ $bankAccount->temporaryDistrict ?? '<span class="empty-value">Not provided</span>' }}</div>
                </div>
                <div class="field">
                    <div class="label">Municipality</div>
                    <div class="value">{{ $bankAccount->temporaryMunicipality ?? '<span class="empty-value">Not provided</span>' }}</div>
                </div>
                <div class="field">
                    <div class="label">Ward No</div>
                    <div class="value">{{ $bankAccount->temporaryWardNo ?? '<span class="empty-value">Not provided</span>' }}</div>
                </div>
                <div class="field">
                    <div class="label">Tole</div>
                    <div class="value">{{ $bankAccount->temporaryTole ?? '<span class="empty-value">Not provided</span>' }}</div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Employment Details Section -->
    <div class="section">
        <div class="section-title">5. Employment Details</div>
        <div class="row">
            <div class="field">
                <div class="label">Job Title</div>
                <div class="value">{{ $bankAccount->jobTitle ?? '<span class="empty-value">Not provided</span>' }}</div>
            </div>
            <div class="field">
                <div class="label">Company Name</div>
                <div class="value">{{ $bankAccount->companyName ?? '<span class="empty-value">Not provided</span>' }}</div>
            </div>
            <div class="field">
                <div class="label">Job Location</div>
                <div class="value">{{ $bankAccount->jobCity ?? '<span class="empty-value">Not provided</span>' }}</div>
            </div>
            <div class="field">
                <div class="label">Monthly Salary</div>
                <div class="value">
                    @if($bankAccount->monthlySalary)
                        Rs. {{ number_format($bankAccount->monthlySalary, 2) }}
                    @else
                        <span class="empty-value">Not provided</span>
                    @endif
                </div>
            </div>
            <div class="field">
                <div class="label">Yearly Salary</div>
                <div class="value">
                    @if($bankAccount->yearlySalary)
                        Rs. {{ number_format($bankAccount->yearlySalary, 2) }}
                    @else
                        <span class="empty-value">Not provided</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Documents Section -->
    <div class="section">
        <div class="section-title">6. Documents</div>
        <div class="signature-container">
            <div class="signature-box">
                <div class="label">Signature</div>
                @if($bankAccount->signature && file_exists(public_path($bankAccount->signature)))
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path($bankAccount->signature))) }}" 
                         class="signature-image" alt="Signature">
                @else
                    <div class="value empty-value">Not provided</div>
                @endif
            </div>
            <div class="signature-box">
                <div class="label">Fingerprint</div>
                @if($bankAccount->fingerPrint && file_exists(public_path($bankAccount->fingerPrint)))
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path($bankAccount->fingerPrint))) }}" 
                         class="signature-image" alt="Fingerprint">
                @else
                    <div class="value empty-value">Not provided</div>
                @endif
            </div>
        </div>
    </div>
</div>
</body>
</html>