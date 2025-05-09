<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Document Attestation #{{ $documentationAttestation->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { color: #0064a7; margin-bottom: 5px; }
        .header .subtitle { color: #666; font-size: 16px; }
        .section { margin-bottom: 25px; }
        .section-title { 
            background-color: #f5f5f5; 
            padding: 8px 15px;
            border-left: 4px solid #0064a7;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .info-table { width: 100%; border-collapse: collapse; }
        .info-table td { padding: 8px 0; border-bottom: 1px solid #eee; }
        .info-table td:first-child { width: 30%; font-weight: bold; color: #555; }
        .signature { margin-top: 50px; border-top: 1px solid #000; width: 300px; }
        .footer { margin-top: 50px; font-size: 12px; color: #666; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h1>DOCUMENT ATTESTATION APPLICATION</h1>
        <div class="subtitle">Reference #{{ $documentationAttestation->id }}</div>
    </div>

    <div class="section">
        <div class="section-title">Basic Information</div>
        <table class="info-table">
            <tr>
                <td>Applicant Name:</td>
                <td>{{ $documentationAttestation->applicantName }}</td>
            </tr>
            <tr>
                <td>Document Type:</td>
                <td>{{ $documentationAttestation->documentType }} ({{ $documentationAttestation->subType }})</td>
            </tr>
            <tr>
                <td>Country for Attestation:</td>
                <td>{{ $documentationAttestation->countryAttestation }}</td>
            </tr>
            <tr>
                <td>Purpose:</td>
                <td>{{ $documentationAttestation->purpose }}</td>
            </tr>
            <tr>
                <td>Application Date:</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Contact Information</div>
        <table class="info-table">
            <tr>
                <td>Email Address:</td>
                <td>{{ $documentationAttestation->email }}</td>
            </tr>
            <tr>
                <td>Primary Contact:</td>
                <td>{{ $documentationAttestation->primaryContact }}</td>
            </tr>
            <tr>
                <td>Secondary Contact:</td>
                <td>{{ $documentationAttestation->secondaryContact ?? 'N/A' }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Delivery Address</div>
        <table class="info-table">
            <tr>
                <td>Country:</td>
                <td>{{ $documentationAttestation->deliveryCountry }}</td>
            </tr>
            <tr>
                <td>City:</td>
                <td>{{ $documentationAttestation->deliveryCity }}</td>
            </tr>
            <tr>
                <td>Street:</td>
                <td>{{ $documentationAttestation->deliveryStreet }}</td>
            </tr>
            <tr>
                <td>Apartment:</td>
                <td>{{ $documentationAttestation->deliveryApartment ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Landmark:</td>
                <td>{{ $documentationAttestation->deliveryLandmark ?? 'N/A' }}</td>
            </tr>
        </table>
    </div>

    @if($documentationAttestation->workCountry)
    <div class="section">
        <div class="section-title">Work Address</div>
        <table class="info-table">
            <tr>
                <td>Country:</td>
                <td>{{ $documentationAttestation->workCountry }}</td>
            </tr>
            <tr>
                <td>City:</td>
                <td>{{ $documentationAttestation->workCity }}</td>
            </tr>
            <tr>
                <td>Street:</td>
                <td>{{ $documentationAttestation->workStreet }}</td>
            </tr>
            <tr>
                <td>Apartment:</td>
                <td>{{ $documentationAttestation->workApartment ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Landmark:</td>
                <td>{{ $documentationAttestation->workLandmark ?? 'N/A' }}</td>
            </tr>
        </table>
    </div>
    @endif

    <div class="section">
        <div class="section-title">Application Status</div>
        <table class="info-table">
            <tr>
                <td>Status:</td>
                <td>{{ ucfirst($documentationAttestation->status) }}</td>
            </tr>
            <tr>
                <td>Payment Status:</td>
                <td>{{ ucfirst($documentationAttestation->paymentStatus) }}</td>
            </tr>
            <tr>
            </tr>
        </table>
    </div>

    <div class="signature">
        <p>Authorized Signature</p>
    </div>

    <div class="footer">
        <p>Generated on {{ now()->format('F j, Y') }} | Document Attestation Service</p>
    </div>
</body>
</html>