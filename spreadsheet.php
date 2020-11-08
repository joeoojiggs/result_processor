<?php
include('php-includes/connect.php');
include('php-includes/check-login-admin.php');

$class_name = ($_POST['class_name']);

if (isset($_POST['process'])){
     
    
    $class_name = mysqli_real_escape_string($con,$_POST['class_name']);

    //run total and average
    $j =1;
    $dql = "select * from students where Class='$class_name'";
    $wuery = mysqli_query($con,$dql);
        if (mysqli_num_rows($wuery) > 0){
            
            while ($low = mysqli_fetch_array($wuery)){
                $reg_no = $low['Reg_Num'];

                $wuery2 = mysqli_query($con,"select * from ".$class_name."_subject1 where reg_no = '$reg_no' "); 
                $low2 = mysqli_fetch_array($wuery2);  
                $total1 = $low2['Total'];

                $wuery2 = mysqli_query($con,"select * from ".$class_name."_subject2 where reg_no = '$reg_no' "); 
                $low2 = mysqli_fetch_array($wuery2);  
                $total2 = $low2['Total'];

                $wuery2 = mysqli_query($con,"select * from ".$class_name."_subject3 where reg_no = '$reg_no' "); 
                $low2 = mysqli_fetch_array($wuery2);  
                $total3 = $low2['Total'];

                $wuery2 = mysqli_query($con,"select * from ".$class_name."_subject4 where reg_no = '$reg_no' "); 
                $low2 = mysqli_fetch_array($wuery2);  
                $total4 = $low2['Total'];

                $wuery2 = mysqli_query($con,"select * from ".$class_name."_subject5 where reg_no = '$reg_no' "); 
                $low2 = mysqli_fetch_array($wuery2);  
                $total5 = $low2['Total'];

                $wuery2 = mysqli_query($con,"select * from ".$class_name."_subject6 where reg_no = '$reg_no' "); 
                $low2 = mysqli_fetch_array($wuery2);  
                $total6 = $low2['Total'];

                $wuery2 = mysqli_query($con,"select * from ".$class_name."_subject7 where reg_no = '$reg_no' "); 
                $low2 = mysqli_fetch_array($wuery2);  
                $total7 = $low2['Total'];

                $wuery2 = mysqli_query($con,"select * from ".$class_name."_subject8 where reg_no = '$reg_no' "); 
                $low2 = mysqli_fetch_array($wuery2);  
                $total8 = $low2['Total'];

                $wuery2 = mysqli_query($con,"select * from ".$class_name."_subject9 where reg_no = '$reg_no' "); 
                $low2 = mysqli_fetch_array($wuery2);  
                $total9 = $low2['Total'];

                $wuery2 = mysqli_query($con,"select * from ".$class_name."_subject10 where reg_no = '$reg_no' "); 
                $low2 = mysqli_fetch_array($wuery2);  
                $total10 = $low2['Total'];

                $wuery2 = mysqli_query($con,"select * from ".$class_name."_subject11 where reg_no = '$reg_no' "); 
                $low2 = mysqli_fetch_array($wuery2);  
                $total11 = $low2['Total'];

                $wuery2 = mysqli_query($con,"select * from ".$class_name."_subject12 where reg_no = '$reg_no' "); 
                $low2 = mysqli_fetch_array($wuery2);  
                $total12 = $low2['Total'];

                $wuery2 = mysqli_query($con,"select * from ".$class_name."_subject13 where reg_no = '$reg_no' "); 
                $low2 = mysqli_fetch_array($wuery2);  
                $total13 = $low2['Total'];

                $wuery2 = mysqli_query($con,"select * from ".$class_name."_subject14 where reg_no = '$reg_no' "); 
                $low2 = mysqli_fetch_array($wuery2);  
                $total14 = $low2['Total'];

                $wuery2 = mysqli_query($con,"select * from ".$class_name."_subject15 where reg_no = '$reg_no' "); 
                $low2 = mysqli_fetch_array($wuery2);  
                $total15 = $low2['Total'];

                $grand_total = $total1 + $total2 + $total3 + $total4 + $total5 + $total6 + $total7 + $total8 + $total9 + $total10 + $total11 + $total12 + $total13 + $total14 + $total15;

                $wuery2 = mysqli_query($con,"select * from ".$class_name."_subject_list "); 
                $num_of_sub = mysqli_num_rows($wuery2);

                $avg = $grand_total/$num_of_sub;

                 $sql4 = "update students set `total` = '$grand_total', `avg` = '$avg' where Reg_Num = '$reg_no' and Class='$class_name'";
                 $query4 = mysqli_query ($con, $sql4);
                        
                    
                $j++;

            }
        }
    
    
    // run grading and position
    $i=1;
    $last_avg = "";
    $last_i;
    $sql ="select * from students where Class='$class_name' order by length(total), total DESC";
    $query= mysqli_query($con,$sql);
        if (mysqli_num_rows($query) > 0) {

            while($row = mysqli_fetch_array($query)) {
                $reg_no = $row['Reg_Num'];

                $query2 = mysqli_query($con,"select * from students where Class='$class_name' and Reg_Num = '$reg_no' "); 
                $row2 = mysqli_fetch_array($query2);  
                $avg = $row2['avg'];
                

                if ($avg >= 70){
                    $grade = 'A';
                }elseif ($avg < 70 && $avg >= 60 ){
                    $grade = 'B';
                }elseif ($avg < 60 && $avg >= 50){
                    $grade = 'C';
                }elseif ($avg < 50 && $avg >= 45){
                    $grade = 'D';
                }elseif ($avg < 45 && $avg >= 40){
                    $grade = 'E';
                }elseif($avg < 40){
                    $grade = 'F';
                }

                if ($avg != $last_avg){

                    if(substr($i, -1) == 1 && substr($i, -2) != 11){

                        $position = $i."ST" ;

                        $sql3 = "update students set `grade` = '$grade', `position` = '$position' where Class='$class_name' and Reg_Num = '$reg_no'";

                    }elseif($i == 2 || $i == 22 || $i == 32 || $i == 42 || $i == 52 || $i == 62 || $i == 72 || $i == 82 || $i == 92 || $i == 102 
                    || $i == 122 || $i == 132 || $i == 142 || $i == 152 || $i == 162 || $i == 172 || $i == 182 || $i == 192 || $i == 202 
                    || $i == 222 || $i == 232 || $i == 242 || $i == 252 || $i == 262 || $i == 272 || $i == 282 || $i == 292 || $i == 302){

                        $position = $i."ND" ;

                        $sql3 = "update students set `grade` = '$grade', `position` = '$position' where Class='$class_name' and Reg_Num = '$reg_no'";
                    }elseif($i == 3 || $i == 23 || $i == 33 || $i == 43 || $i == 53 || $i == 63 || $i == 73 || $i == 83 || $i == 93 || $i == 103 
                    || $i == 123 || $i == 133 || $i == 143 || $i == 153 || $i == 163 || $i == 173 || $i == 183 || $i == 193 || $i == 203 
                    || $i == 223 || $i == 233 || $i == 243 || $i == 253 || $i == 263 || $i == 273 || $i == 283 || $i == 293 || $i == 303){
                        
                        $position = $i."RD" ;

                        $sql3 = "update students set `grade` = '$grade', `position` = '$position' where Class='$class_name' and Reg_Num = '$reg_no'";
                    }else{
                        
                        $position = $i."TH" ;

                        $sql3 = "update students set `grade` = '$grade', `position` = '$position' where Class='$class_name' and Reg_Num = '$reg_no'";
                    }
                    $last_i = $i;
                }else{
                    if($last_i == 1 || $last_i == 21 || $last_i == 31 || $last_i == 41 || $last_i == 51 || $last_i == 61 || $last_i == 71 || $last_i == 81 || $last_i == 91 || $last_i == 101 
                    || $last_i == 121 || $last_i == 131 || $last_i == 141 || $last_i == 151 || $last_i == 161 || $last_i == 171 || $last_i == 181 || $last_i == 191 || $last_i == 201 
                    || $last_i == 221 || $last_i == 231 || $last_i == 241 || $last_i == 251 || $last_i == 261 || $last_i == 271 || $last_i == 281 || $last_i == 291 || $last_i == 301){

                        $position = $last_i."ST" ;

                        $sql3 = "update students set `grade` = '$grade', `position` = '$position' where Class='$class_name' and Reg_Num = '$reg_no'";

                    }elseif($last_i == 2 || $last_i == 22 || $last_i == 32 || $last_i == 42 || $last_i == 52 || $last_i == 62 || $last_i == 72 || $last_i == 82 || $last_i == 92 || $last_i == 102 
                    || $last_i == 122 || $last_i == 132 || $last_i == 142 || $last_i == 152 || $last_i == 162 || $last_i == 172 || $last_i == 182 || $last_i == 192 || $last_i == 202 
                    || $last_i == 222 || $last_i == 232 || $last_i == 242 || $last_i == 252 || $last_i == 262 || $last_i == 272 || $last_i == 282 || $last_i == 292 || $last_i == 302){

                        $position = $last_i."ND" ;

                        $sql3 = "update students set `grade` = '$grade', `position` = '$position' where Class='$class_name' and Reg_Num = '$reg_no'";
                    }elseif($last_i == 3 || $last_i == 23 || $last_i == 33 || $last_i == 43 || $last_i == 53 || $last_i == 63 || $last_i == 73 || $last_i == 83 || $last_i == 93 || $last_i == 103 
                    || $last_i == 123 || $last_i == 133 || $last_i == 143 || $last_i == 153 || $last_i == 163 || $last_i == 173 || $last_i == 183 || $last_i == 193 || $last_i == 203 
                    || $last_i == 223 || $last_i == 233 || $last_i == 243 || $last_i == 253 || $last_i == 263 || $last_i == 273 || $last_i == 283 || $last_i == 293 || $last_i == 303){
                        
                        $position = $last_i."RD" ;

                        $sql3 = "update students set `grade` = '$grade', `position` = '$position' where Class='$class_name' and Reg_Num = '$reg_no'";
                    }else{
                        
                        $position = $last_i."TH" ;

                        $sql3 = "update students set `grade` = '$grade', `position` = '$position' where Class='$class_name' and Reg_Num = '$reg_no'";
                    }
                }

                

                $query3 = mysqli_query($con, $sql3);

                $last_avg = $avg;


                $i++;      
            }
        }

   

    if (empty($query3) && empty($query4)){
        echo '<script>alert("Failed") </script>';
    }else{
        echo '<script>alert("Result successfully graded");</script>';
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SRPS</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        .me {
            display: inline-block;
        }
    </style>
    
       
</head>

<body>

    <div id="wrapper">

     

        <?php
                include('php-includes/menu.php');


        ?>
        
        <div id="page-wrapper" >
            <div class="row">
                <div class="col-lg-12">
                <a type="button" href="<?php echo $class_name?>.php" class="btn btn-danger"><--back</a>
                    <h1 class="page-header">General Class Result Spread Sheet for <?php echo $class_name?>
                     
                    </h1>
                    

    <table class="table table-bordered">
      <thead>
        <tr>
        <th>s/n</th>
          <th>Reg Number</th>
          <th>Full Name</th>
          <th>  
            <?php 
                $thissql1 = "select * from ".$class_name."_subject_list where subject_id = 'subject1' ";
                $thisquery1 = mysqli_query($con, $thissql1); 
                $thisrow1 = mysqli_fetch_array($thisquery1);
                if (isset($thisrow1['subject_name'])){
                    echo $thisrow1['subject_name'];
                }
            ?> 
          </th>
          <th>
            <?php 
                $thissql2 = "select * from ".$class_name."_subject_list where subject_id = 'subject2' ";
                $thisquery2 = mysqli_query($con, $thissql2); 
                $thisrow2 = mysqli_fetch_array($thisquery2);
                if (isset($thisrow2['subject_name'])){
                    echo $thisrow2['subject_name'];
                }
            ?>
          </th>
          <th>
          <?php 
                $thissql3 = "select * from ".$class_name."_subject_list where subject_id = 'subject3' ";
                $thisquery3 = mysqli_query($con, $thissql3); 
                $thisrow3 = mysqli_fetch_array($thisquery3);
                if (isset($thisrow3['subject_name'])){
                    echo $thisrow3['subject_name'];
                } 
            ?>
          </th>
          <th>
          <?php 
                $thissql4 = "select * from ".$class_name."_subject_list where subject_id = 'subject4' ";
                $thisquery4 = mysqli_query($con, $thissql4); 
                $thisrow4 = mysqli_fetch_array($thisquery4);
                if (isset($thisrow4['subject_name'])){
                    echo $thisrow4['subject_name'];
                }
            ?>
          </th>
          <th>
            <?php 
                $thissql5 = "select * from ".$class_name."_subject_list where subject_id = 'subject5' ";
                $thisquery5 = mysqli_query($con, $thissql5); 
                $thisrow5 = mysqli_fetch_array($thisquery5);
                if (isset($thisrow5['subject_name'])){
                    echo $thisrow5['subject_name']; 
                }
            ?>
          </th>
          <th>
            <?php 
                $thissql6 = "select * from ".$class_name."_subject_list where subject_id = 'subject6' ";
                $thisquery6 = mysqli_query($con, $thissql6); 
                $thisrow6 = mysqli_fetch_array($thisquery6);
                if (isset($thisrow6['subject_name'])){
                    echo $thisrow6['subject_name'];
                }
            ?>
          </th>
          <th>
            <?php 
                $thissql7 = "select * from ".$class_name."_subject_list where subject_id = 'subject7' ";
                $thisquery7 = mysqli_query($con, $thissql7); 
                $thisrow7 = mysqli_fetch_array($thisquery7);
                if (isset($thisrow7['subject_name'])){
                    echo $thisrow7['subject_name'];
                }
            ?>
          </th>
          <th>
            <?php 
                $thissql8 = "select * from ".$class_name."_subject_list where subject_id = 'subject8' ";
                $thisquery8 = mysqli_query($con, $thissql8); 
                $thisrow8 = mysqli_fetch_array($thisquery8);
                if (isset($thisrow8['subject_name'])){
                    echo $thisrow8['subject_name'];
                }
            ?>
          </th>
          <th>
            <?php 
                $thissql9 = "select * from ".$class_name."_subject_list where subject_id = 'subject9' ";
                $thisquery9 = mysqli_query($con, $thissql9); 
                $thisrow9 = mysqli_fetch_array($thisquery9);
                if (isset($thisrow9['subject_name'])){
                    echo $thisrow9['subject_name'];
                } 
            ?>
          </th>
          <th>
            <?php 
                $thissql10 = "select * from ".$class_name."_subject_list where subject_id = 'subject10' ";
                $thisquery10 = mysqli_query($con, $thissql10); 
                $thisrow10 = mysqli_fetch_array($thisquery10);
                if (isset($thisrow10['subject_name'])){
                    echo $thisrow10['subject_name'];
                }
            ?>
          </th>
          <th>
            <?php 
                $thissql11 = "select * from ".$class_name."_subject_list where subject_id = 'subject11' ";
                $thisquery11 = mysqli_query($con, $thissql11); 
                $thisrow11 = mysqli_fetch_array($thisquery11);
                if (isset($thisrow11['subject_name'])){
                    echo $thisrow11['subject_name'];
                } 
            ?>
          </th>
          <th>
            <?php 
                $thissql12 = "select * from ".$class_name."_subject_list where subject_id = 'subject12' ";
                $thisquery12 = mysqli_query($con, $thissql12); 
                $thisrow12 = mysqli_fetch_array($thisquery12);
                if (isset($thisrow12['subject_name'])){
                    echo $thisrow12['subject_name'];
                }
            ?>
          </th>
          <th>
            <?php 
                $thissql13 = "select * from ".$class_name."_subject_list where subject_id = 'subject13' ";
                $thisquery13 = mysqli_query($con, $thissql13); 
                $thisrow13 = mysqli_fetch_array($thisquery13);
                if (isset($thisrow13['subject_name'])){
                    echo $thisrow13['subject_name'];
                }
            ?>
          </th>
          <th>
            <?php 
                $thissql14 = "select * from ".$class_name."_subject_list where subject_id = 'subject14' ";
                $thisquery14 = mysqli_query($con, $thissql14); 
                $thisrow14 = mysqli_fetch_array($thisquery14);
                if (isset($thisrow14['subject_name'])){
                    echo $thisrow14['subject_name'];
                }

            ?>
          </th>
          <th>
            <?php 
                $thissql15 = "select * from ".$class_name."_subject_list where subject_id = 'subject15' ";
                $thisquery15 = mysqli_query($con, $thissql15); 
                $thisrow15 = mysqli_fetch_array($thisquery15);
                if (isset($thisrow15['subject_name'])){
                    echo $thisrow15['subject_name'];
                }
            ?>
          </th>
          <th>Total</th>
          <th>AVG.</th>
          <th>Grade</th>
          <th>Postion</th>
          </tr>
          
        
       
      
      </thead>

      <tbody>
     
      <?php
      
          // output data of each row
          $i=1;
           $sql = "select * from students where Class='$class_name'";
          $query= mysqli_query($con,$sql);
          if (mysqli_num_rows($query) > 0) {

          while($row = mysqli_fetch_array($query)) {
            ?> 
               <tr>
               <?php 
                
               $name = $row['First_Name'].' '.$row['Mid_Name'].' '.$row['Last_Name']; ?>
               <td><?php echo $i ?></td>
               <td><?php echo $row['Reg_Num']; ?></td>
               <td><?php echo $name ?></td>
               <td>
               <?php
                    $Reg_Num = $row['Reg_Num'];
                    $osql ="select * from ".$class_name."_subject1 where reg_no = '$Reg_Num'" ;
                    $oquery= mysqli_query($con,$osql);
                    if (mysqli_num_rows($oquery) > 0) {

                        $orow = mysqli_fetch_array($oquery);
                        echo $orow['Total'] ;
                        
                    }
                ?>    
               </td>
         
               
               <td>
                <?php
                    $osql ="select * from ".$class_name."_subject2 where reg_no = '$Reg_Num'" ;
                    $oquery= mysqli_query($con,$osql);
                    if (mysqli_num_rows($oquery) > 0) {

                        $orow = mysqli_fetch_array($oquery);
                        echo $orow['Total'] ;
                        
                    }
                ?>
               </td>
               <td>
               <?php
                    $osql ="select * from ".$class_name."_subject3 where reg_no = '$Reg_Num'" ;
                    $oquery= mysqli_query($con,$osql);
                    if (mysqli_num_rows($oquery) > 0) {

                        $orow = mysqli_fetch_array($oquery);
                        echo $orow['Total'] ;
                        
                    }
                ?>
               </td>
               <td>
               <?php
                    $osql ="select * from ".$class_name."_subject4 where reg_no = '$Reg_Num'" ;
                    $oquery= mysqli_query($con,$osql);
                    if (mysqli_num_rows($oquery) > 0) {

                        $orow = mysqli_fetch_array($oquery);
                        echo $orow['Total'] ;
                        
                    }
                ?>
               </td>
               <td>
               <?php
                    $osql ="select * from ".$class_name."_subject5 where reg_no = '$Reg_Num'" ;
                    $oquery= mysqli_query($con,$osql);
                    if (mysqli_num_rows($oquery) > 0) {

                        $orow = mysqli_fetch_array($oquery);
                        echo $orow['Total'] ;
                        
                    }
                ?>

               </td>
               <td>
               <?php
                    $osql ="select * from ".$class_name."_subject6 where reg_no = '$Reg_Num'" ;
                    $oquery= mysqli_query($con,$osql);
                    if (mysqli_num_rows($oquery) > 0) {

                        $orow = mysqli_fetch_array($oquery);
                        echo $orow['Total'] ;
                        
                    }
                ?>
               </td>
               <td>
               <?php
                    $osql ="select * from ".$class_name."_subject7 where reg_no = '$Reg_Num'" ;
                    $oquery= mysqli_query($con,$osql);
                    if (mysqli_num_rows($oquery) > 0) {

                        $orow = mysqli_fetch_array($oquery);
                        echo $orow['Total'] ;
                        
                    }
                ?>
               </td>

               <td>
               <?php
                    $osql ="select * from ".$class_name."_subject8 where reg_no = '$Reg_Num'" ;
                    $oquery= mysqli_query($con,$osql);
                    if (mysqli_num_rows($oquery) > 0) {

                        $orow = mysqli_fetch_array($oquery);
                        echo $orow['Total'] ;
                        
                    }
                ?>
               </td>
               <td>
               
               <?php
                    $osql ="select * from ".$class_name."_subject9 where reg_no = '$Reg_Num'" ;
                    $oquery= mysqli_query($con,$osql);
                    if (mysqli_num_rows($oquery) > 0) {

                        $orow = mysqli_fetch_array($oquery);
                        echo $orow['Total'] ;
                        
                    }
                ?>
               </td>
               <td>
               <?php
                    $osql ="select * from ".$class_name."_subject10 where reg_no = '$Reg_Num'" ;
                    $oquery= mysqli_query($con,$osql);
                    if (mysqli_num_rows($oquery) > 0) {

                        $orow = mysqli_fetch_array($oquery);
                        echo $orow['Total'] ;
                        
                    }
                ?>
                </td>
               <td>
                    
               <?php
                    $osql ="select * from ".$class_name."_subject11 where reg_no = '$Reg_Num'" ;
                    $oquery= mysqli_query($con,$osql);
                    if (mysqli_num_rows($oquery) > 0) {

                        $orow = mysqli_fetch_array($oquery);
                        echo $orow['Total'] ;
                        
                    }
                ?>
               </td>
               <td>
               <?php
                    $osql ="select * from ".$class_name."_subject12 where reg_no = '$Reg_Num'" ;
                    $oquery= mysqli_query($con,$osql);
                    if (mysqli_num_rows($oquery) > 0) {

                        $orow = mysqli_fetch_array($oquery);
                        echo $orow['Total'] ;
                        
                    }
                ?>
               </td>
               <td>
               <?php
                    $osql ="select * from ".$class_name."_subject13 where reg_no = '$Reg_Num'" ;
                    $oquery= mysqli_query($con,$osql);
                    if (mysqli_num_rows($oquery) > 0) {

                        $orow = mysqli_fetch_array($oquery);
                        echo $orow['Total'] ;
                        
                    }
                ?>
               </td>

               <td>
               <?php
                    $osql ="select * from ".$class_name."_subject14 where reg_no = '$Reg_Num'" ;
                    $oquery= mysqli_query($con,$osql);
                    if (mysqli_num_rows($oquery) > 0) {

                        $orow = mysqli_fetch_array($oquery);
                        echo $orow['Total'] ;
                        
                    }
                ?>
               </td>
               <td>
               <?php
                    $osql ="select * from ".$class_name."_subject15 where reg_no = '$Reg_Num'" ;
                    $oquery= mysqli_query($con,$osql);
                    if (mysqli_num_rows($oquery) > 0) {

                        $orow = mysqli_fetch_array($oquery);
                        echo $orow['Total'] ;
                        
                    }
                ?>
               </td>
               <td>
               <?php echo $row['total']; ?>
               </td>
               <td>
               <?php echo $row['avg']; ?>
               </td>
               <td>
               <?php echo $row['grade']; ?>
               </td>
               <td>
               <?php echo $row['position']; ?>
               </td>
               
               
               
               </tr>
            
          <?php
          $i++;      
          }
          } else {
            ?>
            <tr>
            <td colspan = "20" align="center">
          <h2> 
              No Student in Class
          </h2>
        </td>
        </tr>
          <?php }?>
        </tbody>
        </table>

        <br>
        <br>
        <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-success me" data-toggle="modal" data-target="#myModal">
        RENDER RESULT
        </button>

        <!-- The Modal -->
        <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title text-danger">WARNING</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                Are you sure you want to total the class score, average, grade and assign class position?
                <br>
                <br>

                <form method="POST">

                    <input name="class_name" value="<?php echo $class_name ?>" type="hidden" >
                    <input type="submit" class="btn btn-success" value="Total Now" name="process" />


                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

            </div>
        </div>
        </div>
        <?php
          
          
          mysqli_close($con);
     ?> 
                
                 
                
          
                </div>
                <!-- /.col-lg-12 -->
            </div>
          
            <!-- /.row -->

            <!-- /.row -->
        </div>
   <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="vendor/raphael/raphael.min.js"></script>
    <script src="vendor/morrisjs/morris.min.js"></script>
    <script src="vendor/morrisjs/myjs.js"></script>
    <script src="data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
