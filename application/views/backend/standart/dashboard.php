<style type="text/css">
.widget-user-header {
	padding-left: 20px !important;
}
</style>

<!--<link rel="stylesheet"
	href="<?= BASE_ASSET; ?>fullcalendar/fullcalendar.min.css">
	<link rel="stylesheet"
	href="<?= BASE_ASSET; ?>highcharts/css/highcharts.css">    -->


<section class="content-header">
	<h1>
        <?= cclang('dashboard') ?>
        <small>
            
        <?= cclang('control_panel') ?>
        </small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"> <i class="fa fa-dashboard"> </i>
                <?= cclang('home') ?>
            </a></li>
		<li class="active">
            <?= cclang('dashboard') ?>
        </li>
	</ol>
</section>

<section class="content">
    <div class="container-fluid">
    <div class="row">
		<div class="col-md-4 col-sm-4 col-xs-4">
			<div class="info-box button">
				<span class="info-box-icon bg-aqua">
					<h1>
						<b><?php echo($total_company)?></b>
					</h1>
				</span>
                                 
				<div class="info-box-content">
					<span class="info-box-text"> <b>Total Of Company</b> </span>

				</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-4 col-xs-4">
			<div class="info-box button">
				<span class="info-box-icon bg-yellow">
					<h2>
						<b><?php echo($total_ship)?></b>
					</h2>
				</span>
				<div class="info-box-content">
					<span class="info-box-text"> <b>Total Of Ship</b> </span>

				</div>
			</div>
		</div>

		<div class="col-md-4 col-sm-4 col-xs-4">
			<div class="info-box button">
				<span class="info-box-icon bg-red">
					<h1>
						<b><?php echo($total_task)?></b>
					</h1>
				</span>
				<div class="info-box-content">
					<span class="info-box-text"> <b>Total Of Task</b> </span>

				</div>
			</div>
		</div>
	</div>
        <div class="row">
             <div class="box-body chart-responsive col-md-12 col-sm-12 col-xs-12">
                 <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Information Task List of Company</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool"
                                    data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool"
                                    data-widget="remove">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="chart" id="chart_div" style="height: 300px;"></div>
                </div>        
                   
            </div>
            
            
        </div>
        </div>
</section>
               <!--<script type="text/javascript" src="https://www.google.com/jsapi"></script>-->
 
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
       <script type="text/javascript">
            google.charts.load('current', {packages: ['corechart', 'bar']});
//            google.load("visualization", "1.1", {packages: ['bar', 'timeline']});
            google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

             var data = google.visualization.arrayToDataTable([
                ['Company', 'Requested', 'Completed', 'On-Going','Cancel'],
                <?php
                    foreach ($v_sum_task as $data) {
                        echo "['" .$data->company. "'," . $data->Requested . "," . $data->Completed ."," . $data->Ongoing ."," . $data->Cancel ."],";
 
                    }
                    ?>
                            
                 ]);
              var options = {
//                title: 'Statistic - Total of Task per-Company',
                hAxis: {
                  title: 'Company',

                  viewWindow: {
                    min: [7, 30, 0],
                    max: [17, 30, 0]
                  }
                },
                vAxis: {
                  title: 'Rating (scale of 1-10,000)'
                }
              };

              var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
//              var chart = new google.charts.Bar(document.getElementById('chart_div'));
              chart.draw(data, options);
            }
        </script>