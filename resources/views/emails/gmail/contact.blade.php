<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pesan Kontak Baru</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }
    .email-container {
      max-width: 600px;
      margin: 30px auto;
      background-color: #ffffff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .email-header {
      background-color: #1a73e8;
      color: #ffffff;
      padding: 20px;
      text-align: center;
    }
    .email-header h2 {
      margin: 0;
      font-size: 24px;
    }
    .email-body {
      padding: 20px;
      color: #333333;
    }
    .email-body p {
      margin: 10px 0;
      line-height: 1.6;
    }
    .email-body strong {
      display: inline-block;
      width: 100px;
    }
    .email-footer {
      background-color: #f1f1f1;
      color: #555555;
      text-align: center;
      padding: 15px;
      font-size: 12px;
    }
    @media only screen and (max-width: 600px) {
      .email-body strong {
        display: block;
        width: auto;
        margin-bottom: 5px;
      }
    }
  </style>
</head>
<body>
  <div class="email-container">
    <div class="email-header">
      <h2>New Message</h2>
    </div>
    <div class="email-body">
      <p><strong>Name:</strong> {{ $data['full_name'] }}</p>
      <p><strong>Phone Number:</strong> {{ $data['phone_number'] }}</p>
      <p><strong>Email:</strong> {{ $data['email'] }}</p>
      <p><strong>Message:</strong></p>
      <p>{{ $data['message'] }}</p>
    </div>
    <div class="email-footer">
      &copy; {{ date('Y') }} Pro Billiard Center.
    </div>
  </div>
</body>
</html>
