document.getElementById('rgpdconsentement').addEventListener('change', function () {
    document.getElementById('enterButton').style.display = this.checked ? 'block' : 'none';
});

// vérification du consentement pour accès au site
document.getElementById('enterButton').addEventListener('click', function () {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'consent.php', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            window.location.href = 'form.php';
        }
    }
    xhr.send();
});
