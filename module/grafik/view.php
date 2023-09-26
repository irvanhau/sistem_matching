<?php
include_once('db/bom.php');
include_once('db/analytic.php');
$bom = new bom;
$analytic  = new analytic;
$data = $bom->showData();
?>


<style type="text/css">
    .container {
        width: 50%;
        margin: 15px auto;
    }
</style>
<script src="asset/plugins/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container">
    <select class="form-control " id="analytics">
        <option value="">Pilih BOM:</option>
        <?php
        while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value=" . $row['id'] . ">" . $row['bom_name'] . "</option>";
        }
        ?>
    </select>
</div>

<div class="container">
    <canvas id="myChart" width="100" height="100"></canvas>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-body align-items-center d-flex justify-content-center fs-3">History Matching</h3>
                <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>ID BOM</th>
                            <th>BOM Model</th>
                            <th>ID Part List</th>
                            <th>Part List</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $data = $analytic->showAnalyticTable();
                        while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
                        ?>

                            <tr>
                                <td><?= $row['name'] ?></td>
                                <td><?= $row['bom_id'] ?></td>
                                <td><?= $row['bom_name'] ?></td>
                                <td><?= $row['part_id'] ?></td>
                                <td><?= $row['part_name'] ?></td>
                            </tr>
                        <?php
                        }
                        $data->closeCursor(); ?>


                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div>


<script>
    const ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: 'Matching BOM',
                data: [],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });


    const analytics = document.getElementById('analytics');
    analytics.addEventListener('change', analytic)

    function analytic() {
        var bom_id = $("#analytics").val();
        $.get("http://localhost:88/sistemmatch/db/api.php?bom_id=" + bom_id, function(data) {

            var labels = [];

            var count = [];
            console.log(data);
            data = JSON.parse(data);

            data.forEach(element => {
                labels.push(element['name'])
                count.push(element['countUser'])
            });
            console.log(labels);

            myChart.data.datasets[0].data = count;
            myChart.data.labels = labels;
            myChart.update();


            labels = [];
            count = [];
        })
    }
</script>