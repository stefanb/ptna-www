<!DOCTYPE html>
<html lang="es">

<?php $inc_lang='../../es/'; include $inc_lang.'html-head.inc'; ?>

<?php include('../../script/entries.php'); ?>

    <body>
      <div id="wrapper">
      
<?php include $inc_lang.'header.inc' ?>

        <main id="main" class="results">

            <h2 id="EU"><img src="/img/Nicaragua32.png" alt="bandera Nicaragua" /> Resultados para Nicaragua</h2>
      
<?php include $inc_lang.'results-head.inc' ?>

            <table id="networksEU">
                <thead>
<?php include $inc_lang.'results-trth.inc' ?>
                </thead>
                <tbody>

                    <?php CreateNewFullEntry( "NI-MN-IRTRAMMA", "es", "Configuración" ); ?>

                </tbody>
            </table>

        </main> <!-- main -->

        <hr />

<?php include $inc_lang.'footer.inc' ?>

      </div> <!-- wrapper -->
    </body>
</html>

