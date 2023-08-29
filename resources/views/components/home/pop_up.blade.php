<div class="alert" style="display: none;" id="pop_up">
    <p class="message"></p>
</div>

<script>
    @if (session('success'))
        showAlertWithTimeout("{{ session('success') }}", 'success');
    @endif

    @if (session('error'))
        showAlertWithTimeout("{{ session('error') }}", 'error');
    @endif

    function showAlertWithTimeout(message, type) {
        var alertBox = document.querySelector('.alert');
        var messageBox = alertBox.querySelector('.message');
        messageBox.textContent = message;
        alertBox.classList.add(type);
        alertBox.style.display = 'block';

        setTimeout(function() {
            alertBox.style.display = 'none';
            alertBox.classList.remove(type);
        }, 2000);
    }
</script>

<style>
    .alert {
        position: fixed;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        padding: 10px 20px;
        border-radius: 5px;
        background-color: #333;
        color: #fff;
        display: none;
        z-index: 9999;
    }

    .alert.success {
        background-color: #4CAF50;
    }

    .alert.error {
        background-color: #F44336;
    }
</style>
