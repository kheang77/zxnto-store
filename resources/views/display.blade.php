<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>display View</title>
     <!-- <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            background: #fff;
            padding: 30px;
            width: 350px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .card h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            outline: none;
            transition: 0.3s;
        }

        input[type="text"]:focus {
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102,126,234,0.5);
        }

        .btn {
            width: 100%;
            padding: 12px;
            background: #667eea;
            border: none;
            border-radius: 8px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            background: #5a67d8;
        }
    </style> -->
</head>
<body>
    
    <!-- <form action="{{ url('beltei/submit') }}" method="post" class="card">
        @csrf
        <h2>Score Checker</h2>

        <div class="form-group">
            <label>Laravel Score</label>
            <input type="text" name="laravel">
        </div>

        <div class="form-group">
            <label>API Score</label>
            <input type="text" name="api">
        </div>

        <div class="form-group">
            <label>Network Score</label>
            <input type="text" name="net">
        </div>

        <div class="form-group">
            <label>C# Score</label>
            <input type="text" name="c_sab">
        </div>

        <div class="form-group">
            <label>Client / Server Score</label>
            <input type="text" name="clin">
        </div>

        <button type="submit" class="btn">Check</button>
    </form> -->
    <form action="{{url('beltei/submit')}}" method="post">
        @csrf
        Enter Laravel Score:
        <input type="text" name="laravel" id=""><br>
         Enter API Score:
        <input type="text" name="api" id=""><br>
         Enter Network Score:
        <input type="text" name="net" id=""><br>
         Enter C# Score:
        <input type="text" name="c_sab" id=""><br>
         Enter Clin/Server Score:
        <input type="text" name="clin" id=""><br>

        <input type="submit" value="Check">


    </form>

    {!!'<i>Hello Woed..</i>'!!}<br>

    @php
    $age=25;
    @endphp
    @if($age<18)
    You are young {{$age}}
    @elseif($age>=18 and $age<=25)
    You are adult {{$age}}
    @else
    You are old {{$age}}
    @endif
<br>


    <?php
    $age=18;
    if($age<18){
        echo "You are young ".$age;
    }elseif($age>=18 and $age<=25){
        echo "You are adult ".$age;
    }else{
        echo "You are old ".$age;
    }
     ?>

     <!-- For Loop laravel-->
    <select name="" id="">
    @for($i=1;$i<=10;$i++)
    <option value=""><li>Value I is: {{$i}}</li></option>
    @endfor
    </select>

    @php
    $days = array("PHP","Laravel","HTML","CSS","JavaScript");
    @endphp
    <select name="" id="">
    @foreach($days as $day)
    <option value=""> {{$day}}</option>
    @endforeach
    </select>

    <!-- while loop -->
    <select name="" id="">
    @php
        $c=1;
    @endphp
    @while($c <=10)
    <option value=""><span> my number is: {{$c}}</span> </option>   
        @php
            $c++;
        @endphp
    @endwhile
</select>
    
</body>
</html>
