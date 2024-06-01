<footer>
    <p>&copy;
        <a href="aboutUs.php" class="who">Phisnia</a>. All rights revoked.
    </p>
</footer>

<script>
    window.addEventListener('scroll', function() {
        var footer = document.querySelector('.footer');
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
            footer.style.display = 'block';
        } else {
            footer.style.display = 'none';
        }
    });
</script>
</body>

</html>