<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
    
    <p>Hi All,</p>
    <p>Please note that, an Animal with below details has been {{ $mailMessage }} to the DFMIS System.</p>

    <p><b><u>Details:</u></b></p>

    <ul>
        <li>Animal ID  : <strong>{{ $animalID }}</strong></li>
        <li>Breed      : <strong>{{ $animalBreed }}</strong></li>
        <li>Birth Date : <strong>{{ $birthDate }}</strong></li>
        <li>Gender     : <strong>{{ $gender }}</strong></li>
        <li>Created By : <strong>{{ $createdBy }}</strong></li>
        <li>Created On : <strong>{{ $dtStamp }}</strong></li>
    </ul>

</body>
</html>