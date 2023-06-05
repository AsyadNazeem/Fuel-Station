<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <style>
        body{
            font-family: Arail, sans-serif;
        }
        /* Formatting search box */
        .search-box{
            width: 80%;
            position: relative;
            display: inline-block;
            font-size: 14px;
            margin-left: 15%;
            margin-top: 22%;
        }


        .search-box input[type="text"]{
            height: 32px;
            padding: 5px 10px;
            border: 1px solid #CCCCCC;
            font-size: 14px;
        }
        .result{
            position: absolute;
            z-index: 999;
            top: 100%;
            left: 0;
        }
        .search-box input[type="text"], .result{
            width: 100%;
            box-sizing: border-box;
        }
        /* Formatting result items */
        .result p{
            margin: 0;
            width: 45%;
            padding: 7px 10px;
            border: 1px solid #17a2b8;
            border-top: none;
            cursor: pointer;
            background-color: #b8b9bc;
        }
        .result p:hover{
            background: #4ab4f5;
        }
    </style>



    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./css/new.css">
    <link href="./css/search-filter.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.search-box input[type="text"]').on("keyup input", function(){
                /* Get input value on change */
                var inputVal = $(this).val();
                var resultDropdown = $(this).siblings(".result");
                if(inputVal.length){
                    $.get("backend-search.php", {term: inputVal}).done(function(data){
                        // Display the returned data in browser
                        resultDropdown.html(data);
                    });
                } else{
                    resultDropdown.empty();
                }
            });

            // Set search input value on click of result item
            $(document).on("click", ".result p", function(){
                $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                $(this).parent(".result").empty();
            });
        });
    </script>
</head>
<body>
<form action="./code/fualStation.php" method="get">
<div class="search-box">
    <input  id="search1" name="stationName" AUTOCOMPLETE="OFF" placeholder="Search for Fuel Station" type="text"/>
      <div class="result"></div>
    <button class="sub" name="btn-search"> Search</button>
</div>
</form>

</body>
</html>