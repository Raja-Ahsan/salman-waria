<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title }}</title>
</head>
<body style="margin:0;padding:0;background-color:#0b0f19;font-family:Segoe UI,Roboto,Helvetica,Arial,sans-serif;color:#e5e7eb;">
  <div style="display:none;max-height:0;overflow:hidden;opacity:0;color:transparent;">{{ $preheader }}</div>
  <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background:#0b0f19;padding:28px 12px;">
    <tr>
      <td align="center">
        <table role="presentation" cellpadding="0" cellspacing="0" width="640" style="max-width:640px;background:#121a2a;border:1px solid #243047;border-radius:18px;overflow:hidden;">
          <tr>
            <td style="padding:28px 28px 18px;background:linear-gradient(135deg,#151f33 0%,#0f1625 100%);border-bottom:1px solid #243047;">
              <div style="font-size:12px;letter-spacing:0.14em;text-transform:uppercase;color:#d4af37;font-weight:700;">Salman Waria</div>
              <h1 style="margin:10px 0 8px;font-size:26px;line-height:1.3;color:#ffffff;font-weight:700;">{{ $title }}</h1>
              <p style="margin:0;color:#94a3b8;font-size:15px;line-height:1.6;">{{ $subtitle }}</p>
            </td>
          </tr>
          <tr>
            <td style="padding:24px 28px;color:#cbd5e1;font-size:15px;line-height:1.75;">
              {!! $contentHtml !!}
            </td>
          </tr>
          <tr>
            <td style="padding:18px 28px;border-top:1px solid #243047;background:#0f1625;color:#7f8ea8;font-size:12px;line-height:1.6;">
              <div style="margin-bottom:4px;">{{ $footerNote ?? 'Salman Waria Team' }}</div>
              <div>Sent from salmanwaria.com</div>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
