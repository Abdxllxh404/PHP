<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Example3-1</title>
</head>

<body>
    <?php
      $a = ['img1', 'img10', 'img11', 'img1-1', 'img1-2', 'IMG123'];
      $b = $a;
      echo '<b>ก่อนการเรียงลำดับ:</b><br>';
      echo implode(', ', $a);

      //!implode-ใช้สำหรับการนำข้อมูลStringที่อยู่ในArray มาเรียงต่อกันและสามารถใช้คัวคั่นได้
      //!sort-การเรียงลำดับข้อมูลStringที่อยู่ในตัวแปรArray เท่านั้น
      //!natcasesort-การเรียงลำดับข้อมูลStringที่อยู่ในตัวแปรArray--นิยมใช้มากกว่า---natcase=จะเรียงโดยเอาพิมพ์ใหญ่ไว้หลังสุดต่างกับ--sort


      sort($a);
      echo '<br><br><b>หลังจากการใช้ Sort</b><br>';
      echo implode(', ',$b);


      natcasesort($b);
      echo '<br><br><b>หลังจากการใช้  Natcasesort();</b><br>';
      echo implode(', ',$b);
      
      print '<br>------------------------------------------';

      $x =['AB10','ACD120','ASD145','AAA','A1AA'];
      $y =$x;

      echo '<br><br><b>ก่อนจากการเรียงลำดับ</b><br>';
      echo implode(', ',$x);

      sort($x);
      echo '<br><br><b>หลังจากการใช้ Sort();</b><br>';
      echo implode(', ',$y);

      natcasesort($y);
      echo '<br><br><b>หลังจากการใช้ natcasesort();</b><br>';
      echo implode($y);

      print '<br>------------------------------------------';



?>
</body>

</html>