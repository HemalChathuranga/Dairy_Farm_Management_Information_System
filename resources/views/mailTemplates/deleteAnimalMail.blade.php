<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
    
    <p>Hi All,</p>
    <p>Please note that, The Animal with below details has been {{ $mailMessage }} from the DFMIS System.</p>

    <p><b><u>Details:</u></b></p>

    <ul>
        <li>Animal ID  : <strong>{{ $animalID }}</strong></li>
        <li>Breed      : <strong>{{ $animalBreed }}</strong></li>
        <li>Birth Date : <strong>{{ $birthDate }}</strong></li>
        <li>Gender     : <strong>{{ $gender }}</strong></li>
        <li>Deleted By : <strong>{{ $deletedBy }}</strong></li>
        <li>Deleted On : <strong>{{ $dtStamp }}</strong></li>
    </ul>

    <br>
    <br>
    <br>
    <p>Thank you</p>
    <p>DFMIS System</p>
    <p><i>This is System generated Email. Please do not Reply.</i></p>

</body>
</html>