const msgSuccess = document.getElementById('msg-success');
      

if (msgSuccess) {
    setTimeout(() => {
        msgSuccess.style.display = 'none';
        window.location.href = URL_BASE + '?controller=auth/login&action=login';
    }, 3000);
}