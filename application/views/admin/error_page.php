<div class="main-content">

    <?php
    if (isset($top_header)) {

        echo $top_header;
    }
    ?>

    <hr/>

    <div class="page-error-404">


        <div class="error-symbol">
            <i class="entypo-attention"></i>
        </div>

        <div class="error-text">
            <h2>404</h2>
            <p>Page not found!</p>
        </div>

        <hr/>

    </div>

    <!-- Footer -->
    <?php if (isset($footer)) {
        echo $footer;
    }
    ?>
</div>