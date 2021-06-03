document.addEventListener('DOMContentLoaded', function() {
  if (!document.cookie.split(';').some((item) => item.trim().startsWith('cookieNotice='))) {
      document.getElementById('cookie-notice-confirmation').addEventListener('click', function() {
        document.cookie = `cookieNotice=1; max-age=${60*60*24*365}; SameSite=Strict; path=/`;
        document.getElementById('cookie-notice').classList.add('cookie-notice-hidden');
      });
  }
});
