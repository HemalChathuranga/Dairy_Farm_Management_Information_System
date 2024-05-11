<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
    
    <p>Hi All,</p>
    <p>Please note that, A Milking Infomation has been changed as below by <strong>{{ $editedBy }}</strong> in the DFMIS System.</p>

    <p><b><u>Changes:</u></b></p>

    <p><u>Before:</u></p>
    <table class="table table-bordered" style="text-align: center">
        <thead>
            <tr style="text-align: center">
              <th rowspan="2">Date</th>
              <th rowspan="2">Animal ID</th>
              <th colspan="4" style="background-color: #e7e7f9">Morning</th>
              <th colspan="4" style="background-color: #fadbdb">Evening</th>
              <th rowspan="2" style="background-color: #c7f8ca">Daily Total</th>
            </tr>
            <tr style="text-align: center">
              <th style="background-color: #e7e7f9">Yield<br>(l)</th>
              <th style="background-color: #e7e7f9">Added By<br>(UID)</th>
              <th style="background-color: #e7e7f9">Updated By<br>(UID)</th>
              <th style="background-color: #e7e7f9">Updated Date</th>
              <th style="background-color: #fadbdb">Yield<br>(l)</th>
              <th style="background-color: #fadbdb">Added By<br>(UID)</th>
              <th style="background-color: #fadbdb">Updated By<br>(UID)</th>
              <th style="background-color: #fadbdb">Updated Date</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{ $recordOld->milking_date }}</td>
              <td>{{ $recordOld->animal_id }}</td>
              <td>{{ $recordOld->morning_vol }}</td>
              <td>{{ $recordOld->mor_added_by }}</td>
              <td>{{ $recordOld->mor_updated_by }}</td>
              <td>{{ $recordOld->mor_updated_date }}</td>
              <td>{{ $recordOld->evening_vol }}</td>
              <td>{{ $recordOld->eve_added_by }}</td>
              <td>{{ $recordOld->eve_updated_by }}</td>
              <td>{{ $recordOld->eve_updated_date }}</td>
              <td><strong>{{ ($recordOld->morning_vol + $recordOld->evening_vol) }}</strong></td>
            </tr>
          </tbody>
    </table>

    <br>
    <br>
    <p><u>After:</u></p>
    <table class="table table-bordered" style="text-align: center">
        <thead>
            <tr style="text-align: center">
              <th rowspan="2">Date</th>
              <th rowspan="2">Animal ID</th>
              <th colspan="4" style="background-color: #e7e7f9">Morning</th>
              <th colspan="4" style="background-color: #fadbdb">Evening</th>
              <th rowspan="2" style="background-color: #c7f8ca">Daily Total</th>
            </tr>
            <tr style="text-align: center">
              <th style="background-color: #e7e7f9">Yield<br>(l)</th>
              <th style="background-color: #e7e7f9">Added By<br>(UID)</th>
              <th style="background-color: #e7e7f9">Updated By<br>(UID)</th>
              <th style="background-color: #e7e7f9">Updated Date</th>
              <th style="background-color: #fadbdb">Yield<br>(l)</th>
              <th style="background-color: #fadbdb">Added By<br>(UID)</th>
              <th style="background-color: #fadbdb">Updated By<br>(UID)</th>
              <th style="background-color: #fadbdb">Updated Date</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{ $recordNew->milking_date }}</td>
              <td>{{ $recordNew->animal_id }}</td>
              <td>{{ $recordNew->morning_vol }}</td>
              <td>{{ $recordNew->mor_added_by }}</td>
              <td>{{ $recordNew->mor_updated_by }}</td>
              <td>{{ $recordNew->mor_updated_date }}</td>
              <td>{{ $recordNew->evening_vol }}</td>
              <td>{{ $recordNew->eve_added_by }}</td>
              <td>{{ $recordNew->eve_updated_by }}</td>
              <td>{{ $recordNew->eve_updated_date }}</td>
              <td><strong>{{ ($recordNew->morning_vol + $recordNew->evening_vol) }}</strong></td>
            </tr>
          </tbody>
    </table>

    <br>
    <br>
    <br>
    <p>Thank you</p>
    <p>DFMIS System</p>
    <p><i>This is System generated Email. Please do not Reply.</i></p>

</body>
</html>