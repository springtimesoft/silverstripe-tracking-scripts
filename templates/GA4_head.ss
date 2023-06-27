<% if not $AlreadyIncluded %>window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());<% end_if %>
gtag('config', '{$TrackingID}');
