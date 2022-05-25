<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="http://cdn.rawgit.com/necolas/normalize.css/master/normalize.css">
    <link rel="stylesheet" href="http://cdn.rawgit.com/milligram/milligram/master/dist/milligram.min.css">
    <link rel="stylesheet" href="goals.css" />
    <title>Goal Tracker Timmy version</title>
</head>
<body>
    <div id="container">
        <h1>New Goal</h1>
        <!-- 傳送所有form data去insert_goal.php, 方法是用post -->
        <!-- 會return番數字0,1,2就係等於Personal,Professional,Other-->
        <form action="insert_goal.php" method="post">
            <label for="cat">Category</label>
            <select name="cat" id="cat">
                <option value="0">Personal</option>
                <option value="1">Professional</option>
                <option value="2">Other</option>
            </select>

            <label for="text">Goal</label>
            <textarea name="text" id="text"></textarea>
            <label for="goaldate">Date</label>
            <!-- name屬性非常重要，因為要傳送回php data -->
            <input type="date" id="goldate" name="goldate" />
            <label for="complete">Goal Completed</label>
            <!-- value=1代表完成，0代表未完成 -->
            <input type="checkbox" id="complete" name="complete" value="1"><br />
            <!-- 因為button type就係submit，會引發insert_goal.php運行 -->
            <button type="submit">Submit Goal</button>
        </form>
    <!-- php here --> 

        
      <!-- SELECT * FROM goals -- >>> 從呢個database的table名為goals中提取任何資料* -->
      <!-- require_once 關鍵字用於從另一個文件嵌入 PHP 代碼。 如果未找到該文件，則會引發致命錯誤並停止程序。 如果該文件之前已包含，則此語句將不會再次包含它。 -->
      <!-- $sql = "SELECT * FROM goals" 儲存所有database的資料-->
      <!--  $result = mysqli_query($link, $sql) or die(mysqli_error($link));
      開始運行php啦，使用$result; 傳送$link去我地的database $sql;如果不成功即係瓜左咁點算?
        出現error 囉就係咁簡單 -->      
        <?php
        require_once 'connect.php';
        $sql = "SELECT * FROM goals";
        $result = mysqli_query($link, $sql) or die(mysqli_error($link));
        print("<h2>Incomplete Goals</h2>");

        //Incomplete Goals
        while($row = mysqli_fetch_array($result)) {
            if($row['goal_complete'] == 0){
                if($row['goal_category'] == 0){
                $cat = "Personal";
                } elseif ($row['goal_category' == 1]) {
                $cat = "Professional";
                } else {
                $cat = "Other";
                }
        echo "<div class='goal'>";
        echo "<a href='complete.php?id=" . $row['goal_id'] . "'><button class='btnComplete'>Complete</button></a><strong>";
        echo $cat . "<strong><p>" . $row['goal_text'] . "</p>Goal Date: " . $row['goal_date'];
        echo "</div>";
            }
        }

         //Complete Goals
      print("<h2>Complete Goals</h2>");
      $result = mysqli_query($link, $sql) or die(mysqli_error($link));
      while($row = mysqli_fetch_array($result)){
        if($row['goal_complete'] != 0){
            if($row['goal_category'] == 0){
              $cat = "Personal";
            } elseif ($row['goal_category' == 1]) {
              $cat = "Professional";
            } else {
              $cat = "Other";
            }
            echo "<div class='goal'>";
            echo "<a href='delete.php?id=" . $row['goal_id'] . "'><button class='btnDelete'>Delete</button></a><strong>";
            echo  $cat . "</strong><p>" . $row['goal_text'] . "</p>Goal Date: " . $row['goal_date'];
            echo "</div>";
        }
    }




        ?>






    
</body>
</html>