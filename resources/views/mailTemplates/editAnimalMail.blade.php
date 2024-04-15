<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
    
    <p>Hi All,</p>
    <p>Please note that, The Animal with below details has been {{ $mailMessage }} in the DFMIS System.</p>

    <p><b><u>Details:</u></b></p>

    <ul>
        <li>Animal ID  : <strong>{{ $animalID }}</strong></li>
        <li>Breed      : <strong>{{ $animalBreed }}</strong></li>
        <li>Birth Date : <strong>{{ $birthDate }}</strong></li>
        <li>Gender     : <strong>{{ $gender }}</strong></li>
        <li>Edited By : <strong>{{ $editedBy }}</strong></li>
        <li>Edited On : <strong>{{ $dtStamp }}</strong></li>
    </ul>

</body>
</html>