document.getElementById('rgpdconsentement').addEventListener('change', function () {
    document.getElementById('enterButton').style.display = this.checked ? 'block' : 'none';
});
document.getElementById('enterButton').addEventListener('click', function () {
    window.location.href = 'form.php';
});