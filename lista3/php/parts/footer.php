    <footer>
        <span class="copyright">
            <?php  if (isset($_SESSION['username'])) : ?>
                Logged as: <?php echo $_SESSION['username']; ?>
            <?php endif ?>
            <?php include 'common/counter.php' ?></span>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
    <script src="./assets/main.js"></script>
</body>
</html>