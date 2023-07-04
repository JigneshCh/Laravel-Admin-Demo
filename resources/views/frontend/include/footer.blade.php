<footer class="footer footer-static footer-light">
  <p class="clearfix text-muted text-sm-center px-2">
      <?php $today = getdate(); ?>
        &copy; <a href="#" target="_blank"> {{ config('app.name') }} {{$today['year']}} </a>All Rights
  </p>
</footer>
