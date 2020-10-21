<?php
ini_set('display_errors', 1);
include 'Beehives.php';


//The funtion of simulation
function startWar(){
    $cerana = new Beehives('Cerana');
    $florea = new Beehives('Florea');
    $attackNumber = 1;
    //To show inital state of each colony
    echo '<div style="background:darkorange"> <h1>About each colony (Initial state)</h1><h3>Cerana colony</h3>';
    echo '<h4>Queen Cerena Health Point: '.$cerana->queen->getHealthPoint().'</h4>';
    echo '<h5>Number of worker: '.sizeof($cerana->workers).'</h5> ';
    echo '<h5>Number of warrior: '.sizeof($cerana->warriors).'</h5> ';
    echo '<hr>';
    echo '<h3>Florea colony</h3>';
    echo '<h4>Queen Florea Health Point: '.$florea->queen->getHealthPoint().'</h4>';
    echo '<h5>Number of worker: '.sizeof($florea->workers).'</h5> ';
    echo '<h5>Number of warrior: '.sizeof($florea->warriors).'</h5> ';
    echo '</div>';
    //start attacks
    while(true) {
            $floreaAttackData = $cerana->attack($florea);
            $ceranaAttackData = $florea->attack($cerana);
            echo '<div class="attack" id="attack_'.$attackNumber.'"> <h2> Attack N°'.$attackNumber.'</h2><h3>Cerana colony</h3> <p>'.$floreaAttackData['message'].'</p>';
            echo '<h4>Queen Cerena Health Point: '.$cerana->queen->getHealthPoint().'</h4>';
            echo '<h5>Number of worker: '.sizeof($cerana->workers).'</h5> ';
            echo '<h5>Number of warrior: '.sizeof($cerana->warriors).'</h5> ';
            echo '<hr>';
            echo '<h3>Florea colony</h3> <p>'.$ceranaAttackData['message'].'</p>';
            echo '<h4>Queen Florea Health Point: '.$florea->queen->getHealthPoint().'</h4>';
            echo '<h5>Number of worker: '.sizeof($florea->workers).'</h5> ';
            echo '<h5>Number of warrior: '.sizeof($florea->warriors).'</h5> ';
            echo '</div>';
            //if the queen of ceana colony is dead
            if($ceranaAttackData['isdead']){
                echo '<div id="winner"> <h1>The final winner is '.$florea->getName().'</h1>';
                echo '<span id="time"></span></div>';
                break;
            }
             //if the queen of ceana colony is dead
            if ($floreaAttackData['isdead']){
                echo '<div id="winner"> <h1>The final winner is '.$cerana->getName().'</h1>';
                echo '<span id="time"></span></div>';
                break;
            }    
            $attackNumber++;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Swarm attack</title>
    <style>
        body {
            background-color: lightgray;
        }
        
        div {
            border: 1px solid orange;
            margin: 50px;
            padding: 5px;
            background: white;
        }
        #winner {
            border-color: green;
            background-color: lightgreen;
            text-align: center;
        }
        .attack, #winner {
            display: none;
        }
    </style>
</head>
<body>
    <?php         
        startWar();
    ?>
<script>
    let attackNumber = document.getElementsByClassName('attack').length;
    var i = 1;
    var startTime = new Date();
    var interval = setInterval(() => {
        document.getElementById('attack_'+i).style.display = 'block';
        if(i === attackNumber) {
            document.getElementById('winner').style.display = 'block';
            document.getElementById('time').innerHTML = "The swarm attack ended in "+(new Date() - startTime)/1000 + " Sec.";
            clearInterval(interval)
        };
        window.scrollTo(0,document.body.scrollHeight);
        i++;
    }, 1000);
        

</script>
</body>
</html>