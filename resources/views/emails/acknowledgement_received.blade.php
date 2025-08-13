<!DOCTYPE html>
<html>
<head>
    <title>Acknowledgment Form Received</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f8f9fa; padding: 20px;">
    <div class="container">
        <div class="card shadow-lg mx-auto" style="max-width: 600px; border-radius: 10px;">
            <div class="card-header bg-success text-white text-center" style="border-radius: 10px 10px 0 0;">
                <h3>Acknowledgment Form Received</h3>
            </div>
            <div class="card-body">
                <p class="fw-bold">Dear {{ $contestant->surname }},</p>

                <p class="text-muted">
                    We have received your acknowledgment form. Your submission is currently under review.
                </p>

                <div class="border rounded p-3 mb-3 bg-light">
                    <p><strong>Membership ID:</strong> {{ $contestant->memberId }}</p>
                    <p><strong>Email:</strong> {{ $contestant->email }}</p>
                </div>

                <p class="text-muted">
                    We will notify you once the review is completed.
                </p>
            </div>
            <div class="card-footer text-center text-muted">
                <p>Best regards,<br> <strong>NIPR Election Team</strong></p>
            </div>
        </div>
    </div>
</body>
</html>
