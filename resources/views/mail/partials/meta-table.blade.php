<table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;background:#0d1524;border:1px solid #243047;border-radius:12px;overflow:hidden;">
  @foreach ($rows as $label => $value)
    <tr>
      <td style="padding:12px 14px;border-bottom:1px solid #1e2a3f;width:140px;color:#93a6c6;font-size:13px;vertical-align:top;">{{ $label }}</td>
      <td style="padding:12px 14px;border-bottom:1px solid #1e2a3f;color:#e2e8f0;font-size:14px;">{!! $value !!}</td>
    </tr>
  @endforeach
</table>
