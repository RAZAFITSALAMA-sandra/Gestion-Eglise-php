<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="chartjs/Chart.bundle.js"></script>

<?php 
    $sql=$connexion->query("SELECT montantEntre,dateEntre from entre ORDER BY dateEntre ASC");

    foreach ($sql as $value) {
        $value1[]=$value['montantEntre'];
        $value2[]=$value['dateEntre'];
    }

    $req=$connexion->query("SELECT montantSortie,dateSortie from sortie ORDER BY dateSortie ASC");

    foreach ($req as $val) {
        $val1[]=$val['montantSortie'];
        $val2[]=$val['dateSortie'];
    }
 ?>
<script>
    var ctx=document.getElementById('chart1').getContext('2d');
    var chart=new Chart(ctx,{
        type:"bar",
        data:{
            labels:<?php echo json_encode($value2) ?>,
            datasets:[{
                label:'Entrant',
                backgroundColor:
                    'rgba(54,162,235,0.2)',
                borderColor:
                    'rgba(54,162,235,1)',
                data:<?php echo json_encode($value1) ?>,
                borderWidth:2,
                borderRadius:5
            }]
        },
        options:{
            elements:{
                bar:{
                    borderRadius:5
                }
            }
        }
    });



    var ctx=document.getElementById('chart2').getContext('2d');
    var chart=new Chart(ctx,{
        type:"bar",
        data:{
            labels:<?php echo json_encode($val2) ?>,
            datasets:[{
                label:'Sortant',
                backgroundColor:
                    'rgba(255,99,132,0.2)',
                borderColor:
                    'rgba(255,99,132,1)',
                data:<?php echo json_encode($val1) ?>,
                borderWidth:2,
                borderRadius:5,
            }]
        }
    });
</script>
</body>
</html> 