<?php
$conn=new mysqli("127.0.0.1","root","","_pro");
mysqli_set_charset($conn,"utf8");
require_once('../function/page.php'); //分页类 
$showrow = 5; //一页显示的行数 
$curpage = empty($_GET['page']) ? 1 : $_GET['page']; 
$url = "?page={page}"; //分页地址，如果有检索条件 ="?page={page}&q=".$_GET['q'] 
$sql = "SELECT Ts_ID,ChooseContent,ChooseAns1,ChooseAns2,ChooseAns3,ChooseAns4,RightAns,Pub,ChooseCourse FROM tb_choose"; 
//$total = mysql_num_rows(mysql_query($sql)); //记录总条数 
$total=$conn->query($sql)->num_rows;
if (!empty($_GET['page']) && $total != 0 && $curpage > ceil($total / $showrow)) 
    $curpage = ceil($total_rows / $showrow); //当前页数大于最后页数，取最后一页 
//获取数据 
$sql .= " LIMIT " . ($curpage - 1) * $showrow . ",$showrow;"; 
//$query = mysql_query($sql);

$query=$conn->query($sql);
?>
<!DOCtype>
<html>
<head>
<title>试题信息管理</title>
<style>
table{background-color: white;  width: 500px;height: 100px;margin: 0 auto; border: 1px solid #000;}
td{height: 20px;line-height: 20px;font-family: "微软雅黑";font-size: 14px;font-weight: normal;color: #0080FF;
text-align: center;border: 1px solid #CCC;background-color: white;;
}
#dht{padding:10px;

boder:1px solid#000000;

background: "教官信息管理.jpg";}
</style>
</head>
<body background="教官信息管理.jpg"
      style=" background-repeat:no-repeat ;
background-size:100% 100%;
background-attachment: fixed;">
<div align="center">
<h2>试题信息管理</h2>
</div>
<table>
<tr>

<tr>
<td>题目编号</td>
<td>试题题目</td>
<td>答案A</td>
<td>答案B</td>
<td>答案C</td>
<td>答案D</td>
<td>正确答案</td>
<td>试题是否发布</td>
<td>所属科目</td>
<td></td>
</tr>
<?php while ($row =$query->fetch_array() ) { ?> 
<tr>
<form method="post">
<td><input type="text" readonly="readonly" name="Ts_ID" value="<?php echo $row['Ts_ID']?>"/></td>
<td><input type="text" name="ChooseContent" value="<?php echo $row['ChooseContent']?>"/></td>
<td><input type="text" name="ChooseAns1" value="<?php echo $row['ChooseAns1']?>"/></td>
<td><input type="text" name="ChooseAns2" value="<?php echo $row['ChooseAns2']?>"/></td>
<td><input type="text" name="ChooseAns3" value="<?php echo $row['ChooseAns3']?>"/></td>
<td><input type="text" name="ChooseAns4" value="<?php echo $row['ChooseAns4']?>"/></td>
<td><input type="text" name="RightAns" value="<?php echo $row['RightAns']?>"/></td>
<td><input type="text" name="Pub" value="<?php echo $row['Pub']?>"/></td>
<td><input type="text" name="ChooseCourse" value="<?php echo $row['ChooseCourse']?>"/></td>
<td>
<input type="submit" name="modif" value="修改"/>
<input type="submit" name="delete" value="删除"/></td>
</form>
</tr>
<?php } ?> 
<tr>
<form method="post">
<td></td>
<td><input type="text" name="ChooseContent"/></td>
<td><input type="text" name="ChooseAns1"/></td>
<td><input type="text" name="ChooseAns2"/></td>
<td><input type="text" name="ChooseAns3"/></td>
<td><input type="text" name="ChooseAns4"/></td>
<td><input type="text" name="RightAns"/></td>
<td><input type="text" name="Pub"/></td>
<td><input type="text" name="ChooseCourse"/></td>
<td>
<input type="submit" name="ZJ" value="增加信息" style="height:30px;width:70px;"/></td>
</form>
</tr>
</table> 
<div class="showPage"> 
    <?php 
    if ($total > $showrow) {//总记录数大于每页显示数，显示分页 
        $page = new page($total, $showrow, $curpage, $url, 2); 
        echo $page->myde_write(); 
    } 
    ?> 
</div>

</body>
</html>
<?php
    if(isset($_POST['modif'])){
        $Ts_ID=$_POST['Ts_ID'];
        $ChooseContent=$_POST['ChooseContent'];
        $ChooseAns1=$_POST['ChooseAns1'];
        $ChooseAns2=$_POST['ChooseAns2'];
        $ChooseAns3=$_POST['ChooseAns3'];
        $ChooseAns4=$_POST['ChooseAns4'];
        $RightAns=$_POST['RightAns'];
        $Pub=$_POST['Pub'];
        $ChooseCourse=$_POST['ChooseCourse'];
        $sql1="update tb_choose set ChooseContent='$ChooseContent',ChooseAns1='$ChooseAns1',ChooseAns2='$ChooseAns2',ChooseAns3='$ChooseAns3',ChooseAns4='$ChooseAns4',RightAns='$RightAns',
        Pub='$Pub',ChooseCourse='$ChooseCourse' where Ts_ID='$Ts_ID'";
        $result1=$conn->query($sql1);
        if($result1){
            echo "<script>alert('修改成功！')</script>";
        }
        else{
            echo "<script>alert('系统繁忙，请稍后再试！')</script>";
        }
    }
        if(isset($_POST['delete'])){
        $Ts_ID=$_POST['Ts_ID'];
        $ChooseContent=$_POST['ChooseContent'];
        $ChooseAns1=$_POST['ChooseAns1'];
        $ChooseAns2=$_POST['ChooseAns2'];
        $ChooseAns3=$_POST['ChooseAns3'];
        $ChooseAns4=$_POST['ChooseAns4'];
        $RightAns=$_POST['RightAns'];
        $Pub=$_POST['Pub'];
        $ChooseCourse=$_POST['ChooseCourse'];
        $sql2="delete from tb_choose where Ts_ID='$Ts_ID'";
        $result2=$conn->query($sql2);
        if($result2){
            echo "<script>alert('删除成功！')</script>";
        }
        else{
            echo "<script>alert('系统繁忙，请稍后再试！')</script>";
        }
    }

    if(isset($_POST['ZJ'])){
        $ChooseContent=$_POST['ChooseContent'];
        $ChooseAns1=$_POST['ChooseAns1'];
        $ChooseAns2=$_POST['ChooseAns2'];
        $ChooseAns3=$_POST['ChooseAns3'];
        $ChooseAns4=$_POST['ChooseAns4'];
        $RightAns=$_POST['RightAns'];
        $Pub=$_POST['Pub'];
        $ChooseCourse=$_POST['ChooseCourse'];
        $sql3="insert into tb_choose (ChooseContent,ChooseAns1,ChooseAns2,ChooseAns3,ChooseAns4,RightAns,Pub,ChooseCourse) values ('$ChooseContent','$ChooseAns1','$ChooseAns2','$ChooseAns3',
        '$ChooseAns4','$RightAns','$Pub','$ChooseCourse')";
        $result3=$conn->query($sql3);
        if($result3){
            echo "<script>alert('增加成功！')</script>";
        }
        else{
            echo "<script>alert('系统繁忙，请稍后再试！')</script>";
        }
    }
?>