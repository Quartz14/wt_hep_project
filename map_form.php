<?php include_once 'college_db.php';?>
<?php
if( isset($_GET['submit']) )
{
    //be sure to validate and clean your variables
    $international = htmlentities($_GET['international']);
    $research = htmlentities($_GET['research']);
    $income = htmlentities($_GET['income']);
    $teaching = htmlentities($_GET['teaching']);
    $avg_tution_py = htmlentities($_GET['tution']);
    $acc_rate = htmlentities($_GET['acc_rate']);
    $placement = htmlentities($_GET['placement']);

    $living_cost = htmlentities($_GET['living_cost']);


    //then you can use them in a PHP function.
    echo 'You set international outlook: '.$international.' research outlook: '.$research.' income: '.$income;
    echo "<br>";
    echo 'You set teaching: '.$teaching.' avg tution: '.$avg_tution_py.' acc rate: '.$acc_rate.' placement '.$placement.' living cost: '.$living_cost;
    filter_mappoints($research,$international,$income,$teaching,$avg_tution_py,$acc_rate, $placement, $living_cost );

}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <meta charset="utf-8">




    <title></title>
  </head>
  <body>
    <form action="map.php" method="GET" id="college_filter_form">
        International Outlook(%, greater than): <input type="range" min="0" max="100" name="international" id="international" value=10 step=10 oninput="this.form.international_val.value=this.value"></input>
        <input type="number" name="international_val" id="international_val"  min="0" max="100" step = 10 value=10 oninput="this.form.international.value=this.value">
        <br>
        Research Outlook(%, greater than): <input type="range" min="0" max="100" name="research" id="research" value=10 step=10 oninput="this.form.research_val.value=this.value"></input>
        <input type="number" min="0" max="100" name="research_val" id="research_val" value=10 step=10 oninput="this.form.research.value=this.value"></input>
        <br>
        Income Outlook(%, greater than): <input type="range" min="0" max="100" name="income" id="income" value=10 step=10 oninput="this.form.income_val.value=this.value"></input>
        <input type="number" min="0" max="100" name="income_val" id="income_val" value=10 step=10 oninput="this.form.income.value=this.value"></input>
        <br>

        Teaching(%, greater than): <input type="range" min="10" max="100" value=10 step=10 name="teaching" id="teaching" oninput="this.form.teaching_val.value=this.value"></input>
        <input type="number" min="10" max="100" value=10 step=10 name="teaching_val" id="teaching_val" oninput="this.form.teaching.value=this.value"></input>
        <br>

        Acceptance rate for engineering(%,greater than): <input type="range" min="0.1" max="50" value=0.1 step=1 name="acc_rate" id="acc_rate", oninput="this.form.acc_rate_val.value=this.value"></input>
        <input type="number" min="0.1" max="50" value=0.1 step=1 name="acc_rate_val" id="acc_rate_val" , oninput="this.form.acc_rate.value=this.value"></input>
        <br>


        Average tution fee per year($, less than): <input type="range" min="0" max="110000" value=110000 step=5000 name="tution" id="tution" oninput="this.form.tution_val.value=this.value"></input>
        <input type="number" min="0" max="110000" value=110000 step=5000 name="tution_val" id="tution_val" oninput="this.form.tution.value=this.value"></input>
        <br>

        Average salary from placements($, greater than): <input type="range" min="10000" max="220000" step=10000 value=10000 name="placement" id="placement" oninput="this.form.placement_val.value=this.value"></input>
        <input type="number" min="10000" max="220000" step=10000 value=10000 name="placement_val" id="placement_val" oninput="this.form.placement.value=this.value"></input>
        <br>

        Average living cost per year($, less than): <input type="range" min="0" max="11000" name="living_cost" id="living_cost" oninput="this.form.living_cost_val.value=this.value" step=1000 value=11000></input>
        <input type="number" min="0" max="11000" name="living_cost_val" id="living_cost_val" oninput="this.form.living_cost.value=this.value" step=1000 value=11000></input>
        <br>
        <input type="submit" name="submit" value="Apply filters"></input>
    </form>
    <script>
    international = <?php echo (htmlentities($_GET['international'])) ?>;
    document.getElementById("international").value=international;
    document.getElementById("international_val").value=international;

    research = <?php echo (htmlentities($_GET['research'])) ?>;
    document.getElementById("research").value=research;
    document.getElementById("research_val").value=research;

    income = <?php echo (htmlentities($_GET['income'])) ?>;
    document.getElementById("income").value=income;
    document.getElementById("income_val").value=income;

    teaching = <?php echo (htmlentities($_GET['teaching'])) ?>;
    document.getElementById("teaching").value=teaching;
    document.getElementById("teaching_val").value=teaching;

    acc_rate = <?php echo (htmlentities($_GET['acc_rate'])) ?>;
    document.getElementById("acc_rate").value=acc_rate;
    document.getElementById("acc_rate_val").value=acc_rate;

    tution = <?php echo (htmlentities($_GET['tution'])) ?>;
    document.getElementById("tution").value=tution;
    document.getElementById("tution_val").value=tution;

    placement = <?php echo (htmlentities($_GET['placement'])) ?>;
    document.getElementById("placement").value=placement;
    document.getElementById("placement_val").value=placement;

    living_cost = <?php echo (htmlentities($_GET['living_cost'])) ?>;
    document.getElementById("living_cost").value=living_cost;
    document.getElementById("living_cost_val").value=living_cost;

    </script>

  </body>
</html>
