<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Ajax Notes</title>
    <style>
        body {
            font-family: arial;
        }
        h2 {
            width: 200px;
            margin: auto;
            background: coral;
            color: white;
            text-align: center;
            padding: 7px 10px;
        }
        div.note {
            display: inline-block;
            width: 200px;
            margin: 15px 25px;
            border-bottom: 2px solid gray;
            border-top: 2px solid gray;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding; 
        }
        textarea {
            width: 100%;
            resize: none;
            padding: 10px;
            box-sizing: border-box;
        }
        form.delete input {
            border: none;
            color: cornflowerblue;
            padding: 5px 0px;
            background: none;
            font-size: 1.2rem;
            cursor: pointer;
        }
        form.delete input:hover {
            color: blue;
            transform: scale(1.1);
        }
        #note_form {
            position: fixed;
            bottom: 20px;
            width: 310px;
            left: 50%;
            transform: translateX(-50%);
            background-color: cornflowerblue;
            text-align: center;
            padding: 8px 12px;
        }
        #note_form input {
            padding: 7px 10px;
        }
    </style>
    <script>
        $(document).ready(function() {
            $.get('/notes/display_notes', function(response) {
                $('.notes').html(response);
            });

            $('form#note_form').submit(function() {
                $.post($(this).attr('action'), $(this).serialize(), function(response) {
                    $('.notes').html(response);
                });
                return false;
            });

            $('form.edit').submit(function() {
                $.post($(this).attr('action'), $(this).serialize(), function(response) {
                    $('.notes').html(response);
                });
                return false;
            });
            $('form.delete').submit(function() {
                $.post($(this).attr('action'), $(this).serialize(), function(response) {
                    $('.notes').html(response);
                });
                return false;
            });
            
        }); //READY FUNCTION END 
    </script>
</head>
<body>
    <h2>Ajax Notes</h2>
    <div class="notes"></div>
    <form action="/notes/process_note" id="note_form" method="POST">
    <input type="text" name="note_title" placeholder="Insert note title here...">
    <input type="submit" value="Add Note">
    </form>
</body>
</html>