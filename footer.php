<footer style="background: #f7f7f7" class="">
    <div id="contato" class="container">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1 text-center text-info">
                <h4><strong><a href="http://www.univem.edu.br/" target="_blank">Pós Graduação Univem</a></strong>
                </h4>
                <p><a href="http://poswebmovel.compsi.univem.edu.br" target="_blank">Especialização em Desenvolvimento Web e Aplicativos Móveis</a>
                    <br><a href="mailto:vieiralaf@gmail.com">Luis Augusto Francisco Vieira - RA 342955</a></p>
                <ul class="list-unstyled">
                    <li><small><i class="fa fa-envelope-o fa-fw"></i></small> <a href="mailto:vieiralaf@gmail.com">vieiralaf@gmail.com</a>
                    </li>
                </ul>
                <ul class="list-inline">
                    <li>
                        <small><a href="https://www.facebook.com/luis.vieira.31"><i class="fa fa-facebook fa-fw fa-2x"></i></a></small>
                    </li>
                    <li>
                        <small><a href="https://www.linkedin.com/in/luis-augusto-vieira-1995781a/"><i class="fa fa-linkedin fa-fw fa-2x"></i></a></small>
                    </li>
                </ul>
                <hr class="small">
                <p class="text-muted">Copyright &copy; Sociversidade 2017</p>
            </div>
        </div>
    </div>
    <a id="to-top" href="#top" class="btn btn-dark btn-lg"><i class="fa fa-chevron-up fa-fw fa-1x"></i></a>

</footer>

<script>
    // Scrolls to the selected menu item on the page
    $(function() {
        $('a[href*=#]:not([href=#],[data-toggle],[data-target],[data-slide])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });

</script>



<script>
    //#to-top button appears after scrolling
    var fixed = false;
    $(document).scroll(function() {
        if ($(this).scrollTop() > 250) {
            if (!fixed) {
                fixed = true;
                // $('#to-top').css({position:'fixed', display:'block'});
                $('#to-top').show("slow", function() {
                    $('#to-top').css({
                        position: 'fixed',
                        display: 'block'
                    });
                });
            }
        } else {
            if (fixed) {
                fixed = false;
                $('#to-top').hide("slow", function() {
                    $('#to-top').css({
                        display: 'none'
                    });
                });
            }
        }
    });
 </script>