document.getElementById('logout-form').addEventListener('submit', function() {
    window.location.href = "{{ route('login') }}";
});
