

    <footer class="bg-light py-4">
        <div class="container">
            <p class="text-center m-0 p-0">Copyrights &copy; eStore, 2023.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script>
        if(document.getElementById('search')) {
            document.getElementById('search').addEventListener('keyup', (e) => {
                switch(e.keyCode) {
                    case 13:
                        window.location.href = `http://localhost/e-commerce/shop.php?search=${e.target.value}`
                        break
                }
            })
        }
</script>
</body>
</html>