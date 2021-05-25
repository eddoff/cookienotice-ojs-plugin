let cookieInfoUrl = 'https://publicera.kb.se/kakor';
let cookieDurationDays = 365;

document.addEventListener('DOMContentLoaded', function() {
  if (!document.cookie.split(';').some((item) => item.trim().startsWith('cookieNotice='))) {
      const confirmationHtml = `
        <div id="cookie-notice" class="alert alert-primary" role="alert">
          <div class="container">
            Genom att använda Publicera godkänner du de kakor (cookies) som finns på webbplatsen. <a href="${cookieInfoUrl}">Läs mer om hur vi använder kakor</a>.
            <button id="cookie-notice-confirmation" type="button" class="btn btn-secondary btn-light btn-sm">OK, jag förstår</button>
          </div>
        </div>
      `;
      document.body.insertAdjacentHTML('afterbegin', confirmationHtml);
      document.getElementById('cookie-notice-confirmation').addEventListener('click', function() {
        document.cookie = `cookieNotice=1; max-age=${60*60*24*cookieDurationDays}`;
        document.getElementById('cookie-notice').classList.add('cookie-notice-hidden');
      });
  }
});