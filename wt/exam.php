<!DOCTYPE html>
<?php 
    session_start();
    $db = mysqli_connect('localhost','root','','registration');
?>

<html>
<head>
    <meta charset="UTF-8">
    <style>
        div#test {
            border: #000 1px solid;
            padding: 10px 40px 10px 40px;
        }
    </style>
    <script>
        var pos = 0,test,test_status,question,choice,choices,chA,chB,chC,correct = 0;
      
             var questions = [
                <?php 
            $sql = "SELECT * FROM quiz";
            $res = mysqli_query($db, $sql);
            while($row = mysqli_fetch_assoc($res)) {
        ?>
    ["<?php echo $row['question']; ?>", "<?php echo $row['choice1']; ?>","<?php echo $row['choice2']; ?>","<?php echo $row['choice3']; ?>","<?php echo $row['answer']; ?>"],
    <?php } ?>
             ]
        function _(x) {
            return document.getElementById(x);
        }
        function renderQuestion() {
            test = _("test");
            if(pos >= questions.length) {
                test.innerHTML = "<h2>You got "+correct+" of "+questions.length+" questions correct</h2>";
                _("test_status").innerHTML = "Test Completed";
                pos = 0;
                correct = 0;
                return false;
            }
            _("test_status").innerHTML = "Question "+(pos+1)+" of "+questions.length;
                question = questions[pos][0];
                chA = questions[pos][1];
                chB = questions[pos][2];
                chC = questions[pos][3];
                test.innerHTML ="<h3>"+question+"</h3>";
                test.innerHTML += "<input type='radio' name='choices' value='A'>"+chA+"<br>";
                test.innerHTML += "<input type='radio' name='choices' value='B'>"+chB+"<br>";
                test.innerHTML += "<input type='radio' name='choices' value='C'>"+chC+"<br><br>";
                test.innerHTML += "<button onclick='checkAnswer()'>Submit Answer</button>";
        }
        function checkAnswer() {
            choices = document.getElementsByName("choices");
            for(var i=0; i<choices.length; i++) {
                if(choices[i].checked) {
                    choice = choices[i].value;
                }
            }
            if(choice == questions[pos][4]) {
                correct++;
            }
            pos++;
            renderQuestion();
        }
        window.addEventListener("load",renderQuestion,false);
    </script>
</head>
<body>
    <h2 id="test_status"></h2>
    <div id="test"></div>
</body>
</html>
