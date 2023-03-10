</div>
</div>

<footer class="d-flex justify-content-center align-items-center">
    <p class="m-0">&copy; <?= date('Y') ?> - All rights reserved to HTU</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="<?=$_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST']?>/resources/js/app.js"></script>
<script src=" https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.2.js" integrity="sha256-pkn2CUZmheSeyssYw3vMp1+xyub4m+e+QK4sQskvuo4=" crossorigin="anonymous"></script>

<script>
    <?php if (isset($_SESSION['message'])) : ?>
        alertify.set('notifier','position', 'top-center');
        alertify.<?= $_SESSION['error_type'] ?>('<?= $_SESSION['message'] ?>');
    <?php unset($_SESSION['message']);
    endif; ?>
</script>
</body>
</html>