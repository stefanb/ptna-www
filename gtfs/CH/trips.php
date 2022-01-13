<!DOCTYPE html>
<?php   include( '../../script/globals.php'     );
        include( '../../script/parse_query.php' );
        include( '../../script/gtfs.php'        );
?>
<html lang="<?php echo $html_lang ?>">

<?php $title="GTFS Analysen"; $lang_dir="../../$ptna_lang/"; include $lang_dir.'html-head.inc'; ?>

    <body>

      <div id="wrapper">

<?php include $lang_dir.'header.inc' ?>

        <main id="main" class="results">
            <?php
                $route            = GetRouteDetails( $feed, $release_date, $route_id );
                $comment          =  isset($route["comment"])                                         ? $route["comment"]                        : '';
                $route_short_name = (isset($route["route_short_name"]) && $route["route_short_name"]) ? $route["route_short_name"]               : '???';
                if ( $release_date ) {
                    $feed_and_release = $feed . ' - ' . $release_date;
                } else {
                    $feed_and_release = $feed;
                }
                $osm = GetOsmDetails( $feed, $release_date );
                $ptna_analysis_source = isset($osm['ptna_analysis']) ? $osm['ptna_analysis'] : '';
            ?>

            <h2 id="CH"><a href="index.php"><img src="/img/Switzerland32.png" alt="Schweizerfahne" /></a> GTFS Analysen für <?php if ( $feed && $route_id && $route_short_name ) { echo '<a href="routes.php?feed=' . urlencode($feed) . '&release_date=' . urlencode($release_date) . '">' . htmlspecialchars($feed_and_release) . '</a> Linie "' . htmlspecialchars($route_short_name) . '"'; } else { echo "die Schweiz"; } ?></h2>
            <div class="indent">

                <h3 id="feeds">Verfügbare GTFS-Quellen</h3>
                <div class="indent">

<?php   $months_short = array( "Jan", "Feb", "Mär", "Apr", "Mai", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Dez" );

        CreateGtfsTimeLine( $feed, $release_date, $months_short ) ;

        include $lang_dir.'gtfs-feed-legend.inc';
?>

                </div>

<?php if ( $ptna_analysis_source ): ?>
                <h3 id="ptna-data">PTNA-Analysedaten für diese Linie</h3>
                <div class="indent">
<?php include $lang_dir.'gtfs-ptna-head.inc' ?>

                    <table id="gtfs-ptna">
                        <thead>
<?php include $lang_dir.'gtfs-ptna-trth.inc' ?>
                        </thead>
                        <tbody>
<?php
                            $osm_route_type   =  isset($route["route_type"]) ? RouteType2OsmRoute($route["route_type"]) : '???';
                            $osm_vehicle      =  OsmRoute2Vehicle($osm_route_type,$ptna_lang);
                            $osm_ref          =  $route_short_name;
                            if ( preg_match("/$osm_vehicle$/",$osm_ref) ) {
                                $osm_ref = preg_replace( "/\s+$osm_vehicle$/", "", $osm_ref );
                            }
                            $duration = CreateLinksToPtnaDataEntry( $feed, $release_date, $route_id, $route_short_name, $osm_ref, $osm_route_type, $ptna_analysis_source );
?>
                        </tbody>
                    </table>
                    <?php printf( "<p>Search took %f seconds to complete</p>\n", $duration ); ?>
               </div>
<?php endif; ?>

                <h3 id="routes">Existierende Linienvarianten</h3>
                <div class="indent">

<?php include $lang_dir.'gtfs-trips-head.inc' ?>

                    <table id="gtfs-trips">
                        <thead>
<?php include $lang_dir.'gtfs-trips-trth.inc' ?>
                        </thead>
                        <tbody>
<?php $duration = CreateGtfsTripsEntry( $feed, $release_date, $route_id, $route_short_name ); ?>
                        </tbody>
                    </table>

                    <?php printf( "<p>SQL-Abfrage benötigte %f Sekunden</p>\n", $duration ); ?>
                </div>
            </div>

        </main> <!-- main -->

        <hr />

<?php include $lang_dir.'gtfs-footer.inc' ?>

      </div> <!-- wrapper -->
    </body>
</html>
